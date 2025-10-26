<div class="col header z-3" style="width: 100%; z-index: 1000; margin: 0px">
    <header class="py-3 px-3">
        <div class="container-fluid d-flex gap-3 align-items-center justify-content-between">
            <div class="heading-header-app d-flex gap-2 justify-content-between align-items-center mx-3 p-0">
                <span class="text-white fw-bold ms-lg-0 ms-5 d-none d-lg-block">Dashboard Management</span>
                <span class="text-white fw-bold ms-lg-0 ms-5 d-lg-none">Dashboard Management</span>
            </div>
            <div class="d-none d-xl-flex align-items-center justify-content-end">

                <div class="dropdown me-3">
                    <button class="btn btn-light position-relative" id="notifDropdown" data-bs-toggle="dropdown">
                        🔔
                        <span id="notifBadge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="display:none;">0</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-2" style="width: 320px;" id="notifList">
                        <li class="text-center text-muted small">Tidak ada informasi baru</li>
                    </ul>
                </div>

                <!-- Script sebaiknya di luar div -->
                {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
                

                <span class="px-2 text-white ">Selamat Datang, {{ Auth::user()->name }}</span>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle b"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset(Auth::user()->image) }}" alt="mdo" width="32" height="32"
                            class="rounded-circle bg-white p-1">
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('dashboard.' . Auth::user()->role . '.profile.index') }}">Profile</a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" class="dropdown-item"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
