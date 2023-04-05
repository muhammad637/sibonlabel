  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
          <a href="#" class="logo d-flex align-items-center text-decoration-none">
              <img src="../assets/img/icon/RSUD-logo.png" alt="">
              <span class="d-lg-block">SiBONLABEL</span>
          </a>
      </div>
      <!-- End Logo -->
      {{-- pemanggilan table notifikasi --}}
      @php
      use App\Models\Notifikasi;
        $notifikasiCount = count(Notifikasi::where('user_id', auth()->user()->id)->get());
        $notifikasi= Notifikasi::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->limit(3)->get();
      @endphp
      <nav class="header-nav ms-auto ">
          <ul class="d-flex align-items-center">
              <li>
                  <div class="nav-item dropdown">
                      <a class="nav-link nav-icon text-decoration-none" href="#" data-bs-toggle="dropdown">
                          <i class="bi bi-bell"></i>
                          <span class="badge bg-primary badge-number">{{ $notifikasiCount }}</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end notifications">
                          <li class="dropdown-header">
                              You have {{ $notifikasiCount }} notifications
                              <a href="#" class="text-decoration-none">
                                  <span class="badge rounded-pill bg-primary p-2 ms-2">View all
                                  </span>
                              </a>
                          </li>
                          <li>
                              <hr class="dropdown-divider">
                          </li>
                          @foreach ($notifikasi as $n)
                          <li class="notification-item">
                            <i class="bi {{$n->status == 'gagal' ? 'bi-x-circle text-danger' :  'bi-check-circle text-success'}} "></i>
                            <div>
                                <h4>tabel {{$n->nama_table}}</h4>
                                <p>{{$n->msg}}</p>
                                <p>{{$n->created_at->diffForHumans()}}</p>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                          @endforeach
                         
                          <li class="dropdown-footer">
                            <a href="#" class="text-decoration-none">Show all notifications</a>
                        </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item dropdown pe-1">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                      data-bs-toggle="dropdown">
                      <span class="d-none d-md-block ps-2 m-2">{{ auth()->user()->nama }}</span>
                      <div class="rounded-circle">
                          <i class="bi bi-person-circle fs-2"></i>
                      </div>
                  </a><!-- End Profile Iamge Icon -->

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                      <li class="dropdown-header">
                          {{ auth()->user()->nama }}
                          <br></br>
                          <span class="fw-semibold">{{ auth()->user()->cekLevel }}</span>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                              <i class="bi bi-person"></i>
                              <span>My Profile</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                              <i class="bi bi-gear"></i>
                              <span>Account Settings</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                              <i class="bi bi-question-circle"></i>
                              <span>Need Help?</span>
                          </a>
                      </li>
                      <li>
                          <hr class="dropdown-divider">
                      </li>

                      <li>
                          <a class="dropdown-item d-flex align-items-center" href="/logout">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                          </a>
                      </li>

                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->
              <li class="nav-item mr-3 pe-4">
                  <i class="bi bi-list toggle-sidebar-btn"></i>
              </li>
          </ul>
      </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
