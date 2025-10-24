<ul class="nav nav-secondary">
    <li class="nav-item {{ request()->is('dashboard/administrator/*') ? '' : 'active' }}">
        <a href="{{ route('dashboard.administrator.index') }}" class="collapsed">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Kelola Data</h4>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['homepage-setup', 'hero-promo']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#homepage-setup-collapse">
            <i class="fas fa-images"></i>
            <p>Setup Homepage</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="homepage-setup-collapse">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.administrator.homepage-setup') }}" class="<?php echo isKeywordActive(['homepage-setup']) ? 'active' : ''; ?>">
                        <span class="sub-item">Pengaturan Hero Homepage</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.hero-promo') }}" class="<?php echo isKeywordActive(['hero-promo']) ? 'active' : ''; ?>">
                        <span class="sub-item">Pengaturan Hero Promo</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item {{ request()->is('dashboard/administrator/program') ? 'active' : '' }}">
        <a href="{{ route('dashboard.administrator.program.index') }}" class="collapsed">
            <i class="fas fa-list"></i>
            <p>Program</p>
        </a>
    </li>

    <li class="nav-item {{ request()->is('dashboard/administrator/testimoni') ? 'active' : '' }}">
        <a href="{{ route('dashboard.administrator.testimoni.index') }}" class="collapsed">
            <i class="far fa-comments"></i>
            <p>Testimoni</p>
        </a>
    </li>

    <li class="nav-item {{ request()->is('dashboard/administrator/fasilitas') ? 'active' : '' }}">
        <a href="{{ route('dashboard.administrator.fasilitas.index') }}" class="collapsed">
            <i class="fas fa-shapes"></i>
            <p>Fasilitas</p>
        </a>
    </li>

    <li class="nav-item {{ request()->is('dashboard/administrator/kenapa') ? 'active' : '' }}">
        <a href="{{ route('dashboard.administrator.kenapa.index') }}" class="collapsed">
            <i class="fas fa-question-circle"></i>
            <p>Kenapa Pilih Brainco</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['profil_kami', 'sejarah', 'struktur_organisasi','unit_usaha', 'penghargaan']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#tentang-kami-collapse">
            <i class="far fa-address-card"></i>
            <p>Tentang Kami</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="tentang-kami-collapse">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.administrator.tentang_kami.profil_kami.index') }}"
                        class="<?php echo isKeywordActive(['profil_kami']) ? 'active' : ''; ?>">
                        <span class="sub-item">Profil Kami</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.tentang_kami.sejarah.index') }}"
                        class="<?php echo isKeywordActive(['sejarah']) ? 'active' : ''; ?>">
                        <span class="sub-item">Sejarah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.tentang_kami.struktur_organisasi.index') }}"
                        class="<?php echo isKeywordActive(['struktur_organisasi']) ? 'active' : ''; ?>">
                        <span class="sub-item">Struktur Organisasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.tentang_kami.unit_usaha.index') }}"
                        class="<?php echo isKeywordActive(['unit_usaha']) ? 'active' : ''; ?>">
                        <span class="sub-item">Unit Usaha</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.tentang_kami.penghargaan.index') }}"
                        class="<?php echo isKeywordActive(['penghargaan']) ? 'active' : ''; ?>">
                        <span class="sub-item">Penghaargaan</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['user', 'role_user']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#user-management-collapse">
            <i class="fas fa-user"></i>
            <p>Manajemen User</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="user-management-collapse">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.administrator.user.index') }}" class="<?php echo isKeywordActive(['users']) ? 'active' : ''; ?>">
                        <span class="sub-item">Data User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.role_user.index') }}" class="<?php echo isKeywordActive(['role_user']) ? 'active' : ''; ?>">
                        <span class="sub-item">Role User</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['pesan']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.administrator.pesan.index') }}" class="collapsed">
            <i class="fas fa-envelope"></i>
            <p>Pesan</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['berita', 'kategori', 'redaktur']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#news-management-collapse">
            <i class="fas fa-newspaper"></i>
            <p>Manajemen Berita</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="news-management-collapse">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.administrator.berita.index') }}" class="<?php echo isKeywordActive(['berita']) ? 'active' : ''; ?>">
                        <span class="sub-item">Daftar Berita</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.kategori.index') }}" class="<?php echo isKeywordActive(['kategori']) ? 'active' : ''; ?>">
                        <span class="sub-item">Kategori Berita</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.redaktur.index') }}" class="<?php echo isKeywordActive(['redaktur']) ? 'active' : ''; ?>">
                        <span class="sub-item">Redaktur</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['galeri', 'galeri-video', 'kategori-galeri']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#gallery-management-collapse">
            <i class="fas fa-images"></i>
            <p>Manajemen Galeri</p>
            <span class="caret"></span>
        </a>
        <div class="collapse" id="gallery-management-collapse">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.administrator.galeri.index') }}" class="<?php echo isKeywordActive(['galeri']) ? 'active' : ''; ?>">
                        <span class="sub-item">List Galeri Foto</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.galeri-video.index') }}" class="<?php echo isKeywordActive(['galeri-video']) ? 'active' : ''; ?>">
                        <span class="sub-item">List Galeri Video</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.administrator.kategori-galeri.index') }}"
                        class="<?php echo isKeywordActive(['kategori-galeri']) ? 'active' : ''; ?>">
                        <span class="sub-item">Kategori Galeri</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['about']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.administrator.about.index') }}" class="collapsed">
            <i class="far fa-address-card"></i>
            <p>About</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['file-manager']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.administrator.file-manager.index') }}" class="collapsed">
            <i class="fas fa-folder-open"></i>
            <p>File Manager</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['info']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.administrator.info.index') }}" class="collapsed">
            <i class="fas fa-cogs"></i>
            <p>Pengaturan</p>
        </a>
    </li>
</ul>
