<div class="row">
  <div class="col-md-12">
    @forelse($rewards as $reward)
      <div class="col-md-4 col-sm-6">
         <div class"form-group">
              <label for="price">
                {!! trans('reward::reward.label.price') !!}
              </label><br />
              {!! $reward['price'] !!}
         </div>
      </div>
      <div class="col-md-4 col-sm-6">
         <div class"form-group">
              <label for="status">
                {!! trans('reward::reward.label.status') !!}
              </label><br />
              {!! $reward['status'] !!}
         </div>
      </div>
[<a href='/reward/reward/{{ $reward['slug'] }}'>View</a>]
<hr>
    @empty
    <p>No rewards</p>
    @endif
  </div>
</div>