 <!-- Product Quick View Modal -->

 <div class="modal fade" id="quickview" tabindex="-1" role="dialog"  aria-hidden="true">
		<div class="modal-dialog quickview-modal modal-dialog-centered modal-lg" role="document">
		  <div class="modal-content">
			<div class="submit-loader">
				<img src="" alt="">
			</div>

			<div class="modal-body">
				<div class="container quick-view-modal">

				</div>
			</div>
		  </div>
		</div>
	  </div>
<!-- Product Quick View Modal --> 

<!-- LOGIN MODAL -->
<div class="modal fade" id="comment-log-reg" tabindex="-1" role="dialog" aria-labelledby="comment-log-reg-Title"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <nav class="comment-log-reg-tabmenu">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link login active" id="nav-log-tab1" data-toggle="tab" href="#nav-log1"
                            role="tab" aria-controls="nav-log" aria-selected="true">
                            Login
                        </a>
                        <a class="nav-item nav-link" id="nav-reg-tab1" data-toggle="tab" href="#nav-reg1" role="tab"
                            aria-controls="nav-reg" aria-selected="false">
                            Register
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-log1" role="tabpanel"
                        aria-labelledby="nav-log-tab1">
                        <div class="login-area">
                            <div class="login-form signin-form mt-3">
                                @include('includes.admin.form-login')
                                <form class="mloginform" action="{{ route('user.login.submit') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="email" placeholder="Email"
                                            required="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="password" class="Password" name="password"
                                            placeholder="Password" required="">
                                    </div>
                                    <div class="form-forgot-pass">
                                        <div class="left form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="mrp"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label for="mrp">Remember</label>
                                        </div>
                                        <div class="right">
                                            <a href="javascript:;" id="show-forgot">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <input class="form-control" type="hidden" name="modal" value="1">
                                    <button type="submit" class="btn mt-45">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-reg1" role="tabpanel" aria-labelledby="nav-reg-tab1">
                        <div class="login-area signup-area">
                            <div class="login-form signup-form mt-3">
                                @include('includes.admin.form-login')
                                <form class="mregisterform" action="{{route('user-register-submit')}}"
                                    method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <input class="form-control" type="text" class="User Name" name="name"
                                            placeholder="Username" required="">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="email" class="User Name" name="email"
                                            placeholder="Email" required="">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="text" class="User Name" name="phone"
                                            placeholder="Phone" required="">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="text" class="User Name" name="address"
                                            placeholder="Address" required="">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="password" class="Password" name="password"
                                            placeholder="Password" required="">
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="password" class="Password" name="password_confirmation"
                                            placeholder="Repeat Password" required="">
                                    </div>
                                    <button type="submit" class="btn mt-45">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN MODAL ENDS -->