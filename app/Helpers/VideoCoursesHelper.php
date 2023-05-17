<?php

namespace App\Helpers;

use App\Models\Consts\QuestionConstants;
use App\Models\Home\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoCoursesHelper
{
    /**
     * id сервиса видеокурсы.
     */
    const SERVICES_ID = 22;

    /**
     * Возвращает массив пользователей которые оплатили видеокурсы.
     *
     * @return array
     */
    public static function getArrayUsersPaid(): array
    {
        $servicesId = self::SERVICES_ID;
        $sql = "
            SELECT
                DISTINCT booking.user_id
            FROM
                booking_detail
            LEFT JOIN booking ON booking.id = booking_detail.booking_id
            WHERE booking_detail.services_id = {$servicesId}
        ";
        $result = DB::select( DB::raw( $sql ) );

        // https://stackoverflow.com/questions/37517728/laravel-5-1-dbselect-toarray
        $result = array_map(function ($value) {
            return ((array)$value)['user_id'];
        }, $result);

        return $result;
    }

    /**
     * Возвращает 1 если пользователь приобрел видеокуры, иначе 0.
     *
     * @return int
     */
    public static function getIsPaid()
    {
        $countPaidVideoCourses = DB::table('booking')
            ->leftJoin('booking_detail', 'booking.id', '=', 'booking_detail.booking_id')
            ->where('booking.user_id', '=', Auth::user()->id)
            // 22,video_courses,Видеокурсы,Video courses,90.00,3,1,2020-12-29 10:23:28,2020-12-29 10:23:28
            ->where('booking_detail.services_id', '=', self::SERVICES_ID)
            ->count();

        return ($countPaidVideoCourses > 0) ? 1 : 0;
    }

    /**
     * Отвечает на вопрос сдал ли экзамен текущий пользователь для указаного модуля.
     * @param int $moduleId
     * @return int
     */
    private static function passExam(int $moduleId)
    {
        $countAnswer = DB::table('answer')
            ->leftJoin('questions', 'answer.question_id', '=', 'questions.id')
            ->where('answer.user_id' , '=', Auth::user()->id)
            ->where('questions.module_id', '=', $moduleId)
            ->count();

        return ($countAnswer > 0) ? 1 : 0;
    }

    /**
     * Возвращает массив видеоуроков которые прошел пользователь.
     *
     * @return array
     */
    public static function getArrayShowVideo()
    {
        $video = [1 => 1];

        for ( $moduleId = 2; $moduleId <= count(QuestionConstants::MODULE); $moduleId++ ) {
            if ( self::passExam( $moduleId - 1 ) === 1 ) {
                $video += [ $moduleId => 1 ];
            } else {
                $video += [ $moduleId => 0 ];
            }
        }

        return $video;
    }

    /**
     * Возвращает массив для кнопок Экзамен.
     * 1 - кнопка доступна
     * 0 - не доступна.
     *
     * @return array
     */
    public static function getArrayShowButton()
    {
        $button = [];

        for ( $moduleId = 1; $moduleId <= count(QuestionConstants::MODULE); $moduleId++ ) {
            if ( $moduleId === 1 ) {
                // Если модуль не пройден
                if ( self::passExam( 1 ) === 0 ) {
                    $button += [ 1 => 1];
                } else {
                    $button += [ 1 => 0];
                }
            } else {
                // Если текущий видеокурс не пройден но предыдущий пройден то отрисовывем кнопку
                if ( (self::passExam( $moduleId ) === 0) && (self::passExam( $moduleId - 1 ) === 1) ) {
                    $button += [ $moduleId => 1];
                } else {
                    $button += [ $moduleId => 0];
                }
            }
        }

        return $button;
    }
}
