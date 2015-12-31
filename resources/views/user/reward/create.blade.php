{!!Former::horizontal_open()
->id('create-reward-reward')
->method('POST')
->files('true')
->action(URL::to('user/reward/reward'))!!}
@include('reward::user.reward.partial.entry')
{!! Former::close() !!}