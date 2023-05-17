<?php

namespace App\Models\Home\Ticket;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'theme',
        'appeal_id',
        'question',
        'user_id',
        'ticket_status_id',
    ];

    protected $appends = [
        'admin_not_viewed',
        'not_viewed'
    ];

    public function appeal(): BelongsTo
    {
        return $this->BelongsTo(Appeal::Class, 'appeal_id', 'id')
            ->withDefault();
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::Class, 'user_id', 'id')
            ->withDefault();
    }

    public function ticketStatus(): BelongsTo
    {
        return $this->BelongsTo(TicketStatus::Class, 'ticket_status_id', 'id')
            ->withDefault();
    }

    public function getQuestionShortAttribute()
    {
        return mb_substr( $this->question, 0, 256 );
    }

    public function attachment(): hasMany
    {
        return $this->hasMany('Models/Home/Ticket/Attachment');
    }

    public function getAttachmentCountAttribute()
    {
        return Attachment::on()->where('ticket_id', $this->id)->count('*');
//        return $this->attachment->where('ticket_id', $this->id)->count('*');
    }

    public function getAuthorNameAttribute()
    {
        return $this->user->surname . ' ' . $this->user->name;
    }

    public function getAuthorEmailAttribute()
    {
        return $this->user->email;
    }

    public function getAuthorPhoneAttribute()
    {
        return $this->user->phone;
    }

    public function getResponsibleAttribute()
    {
        $responsibleFullName = '';
        if ( $this->appeal_id == Appeal::TECHNICAL_DIFFICULTIES || $this->appeal_id == Appeal::DEPOSIT_WITHDRAWAL ) {
            return 'Dinway';
        }

        $parentId =  User::find( $this->user_id )->parent_id;
        $userMentor = User::find($parentId) ;

        if ( ! is_null( $userMentor )  ) {
                $responsibleFullName = ( ( ! is_null( $userMentor->surname ) ) ? $userMentor->surname : '')
                    . ' ' .
                    ( ! is_null( $userMentor->name ) ) ? $userMentor->name : '';
        }
        return $responsibleFullName;
    }

    public function getNotViewedAttribute()
    {
        return TicketAnswer::query()->whereHas('ticket', function (Builder $query) {
            $query->where('user_id', auth()->user()->id)
                ->where('id', '=', $this->id);
        })
            ->where('user_id', '!=', auth()->user()->id)
            ->where('viewed', '=', 0)
            ->count();
    }

    public function getAdminNotViewedAttribute()
    {
        return TicketAnswer::query()->whereHas('user', function (Builder $query) {
            $query->where('admin', 0);
        })
            ->where([
                'ticket_id' => $this->id,
                'viewed' => 0
            ])
            ->count();
    }
}
