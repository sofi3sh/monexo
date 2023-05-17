@if(Auth::user()->bonus_level >= 1)
    <div class="card bg-default shadow">
        <div class="card-header bg-transparent border-0">
            <h3 class="text-white mb-0">
                @lang('base.dash.partners.emails.title')
            </h3>
        </div>
        <div class="card-body">
            <form action="{{route('home.partners-emails')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <label for="" class="text-white">
                        @lang('base.dash.partners.emails.theme')
                    </label>
                    <input name="title" class="form-control" type="text">
                </div>
                <div class="form-group">
                <label for="" class="text-white">
                    @lang('base.dash.partners.emails.message')
                </label>
                <textarea name="content" class="form-control" id="" rows="5"></textarea>
                </div>
                <button class="btn btn-success">
                    @lang('base.dash.partners.emails.send')
                </button>
            </form>
        </div>
    </div>
@endif