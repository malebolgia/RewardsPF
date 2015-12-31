<div class='col-md-4 col-sm-6'>
               {!! Former::decimal('price')
               -> label(trans('reward::reward.label.price'))
               -> placeholder(trans('reward::reward.placeholder.price'))!!}
               </div>
                    <div class='col-md-4 col-sm-6'>
               {!! Former::select('status')
               -> options(trans('reward::reward.options.status'))
               -> label(trans('reward::reward.label.status'))
               -> placeholder(trans('reward::reward.placeholder.status'))!!}
               </div>

          

{!!   Former::actions()
->large_primary_submit('Submit')
->large_inverse_reset('Reset')
!!}