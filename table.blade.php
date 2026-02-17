     @if ($booking_types->count())
         <table class="table table-bordered" id="booking_types_table" data-route="{{ route('booking_type.table') }}">
             <thead>
                 <tr>
                     <th style="width:60px">{{ translate('SL No') }}</th> 
                     <th>{{ translate('Name') }}</th>
                     <th style="width:100px"></th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($booking_types as $booking_type_item)
                     <tr>
                         @if (method_exists($booking_types, 'currentPage'))
                             <td>{{ ($booking_types->currentPage() - 1) * $booking_types->perPage() + $loop->iteration }}</td>
                         @else
                             <td>{{ $loop->iteration }}</td>
                         @endif 
                         <td>{{ $booking_type_item->name }}</td>
                         <td class="right">
                             <div class="dropdown notification-list dropdown">
                                 <a class="btaction" data-toggle="dropdown" href="#" role="button"
                                     aria-haspopup="false" aria-expanded="false">Action <i
                                         class="icon-arrow-down-circle"></i></a>
                                 <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                     <a href="#" class="dropdown-item notify-item" data-module="booking_types"
                                         data-id="{{ $booking_type_item->id }}"
                                         data-route-store="{{ route('booking_type.store') }}"
                                         data-route-form="{{ route('booking_type.form') }}"
                                         data-route-edit="{{ route('booking_type.edit', ':id') }}"
                                         data-route-update="{{ route('booking_type.update', ':id') }}"
                                         onclick="form_modal(this)">{{ translate('Edit') }}</a>
                                     <a href="#" class="dropdown-item notify-item" data-module="booking_types"
                                         data-id="{{ $booking_type_item->id }}"
                                         data-route="{{ route('booking_type.delete', ':id') }}"
                                         onclick="erp_delete(this)">{{ translate('Delete') }}</a>
                                 </div>
                             </div>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>

         @if (method_exists($booking_types, 'links'))
             <div class="pagination-wrapper">
                 {{ $booking_types->appends(['wrapper' => 'booking_types_table_wrapper'])->links() }}
             </div>
         @endif
     @else 
         <div class="col-md-12 col-md-12-padding">
             <div class="box ">
                 <div class="box-body">

                     <div class="intro text-center">
                         <div class="videoimg"> </div>
                         <h3>{{ translate('Empty List') }}</h3>
                         <p class="text-muted">{{ translate('No Data Found') }}</p>

                     </div>
                 </div>

                 <div class="box-footer clearfix">

                 </div>
             </div>
         </div>


     @endif
