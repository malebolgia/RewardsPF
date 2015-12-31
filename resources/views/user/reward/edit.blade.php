{!!Former::horizontal_open()
->id('edit-reward-reward')
->method('PUT')
->files('true')
->action(URL::to('user/reward/reward') .'/'.$reward['eid'])!!}
@include('reward::user.reward.partial.entry')
{!! Former::close() !!}