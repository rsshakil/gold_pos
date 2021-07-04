<div class="modal fade" id="permission_show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permission_modal_heading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="total_permission"></div>
                <div id="all_permission_show"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
            </div>
        </div>
    </div>
</div>

<!--maker modal-->
<div id="new_maker_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="z-index: 1600;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
      	
      <form method="POST" id="maker_create" class="">
                    @csrf
                    
                    <input type="hidden" class="user_type" name="user_type" value="1">
                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label">{{__('messages.name')}}</label>

                        <div class="col-md-8">
                            <input id="username" type="text" class="form-control" name="username" required autofocus
                                placeholder="{{__('messages.name')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="useremail" class="col-md-4 col-form-label">{{__('messages.email')}}</label>
                        <div class="col-md-8">
                            <input id="useremail" type="email" class="form-control" name="useremail"
                                placeholder="{{__('messages.email')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label">{{__('messages.outlet_phone')}}</label>
                        <div class="col-md-8">
                            <input id="userphone" type="text" class="form-control" name="userphone"
                                placeholder="{{__('messages.outlet_phone')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="useraddress"
                            class="col-md-4 col-form-label">Address</label>
                        <div class="col-md-8">
                                <input id="useraddress" type="text" class="form-control"
                                name="useraddress" placeholder="{{__('messages.address')}}" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_maker_save">{{__('messages.submit')}}</button>
            </div>
            </form>
      	
      </div>      
    </div>
  </div>
</div>
<!--maker modal-->