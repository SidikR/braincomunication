<ul class="nav nav-secondary">

    <li class="nav-item {{ request()->is('dashboard/staf_administrasi/*') ? '' : 'active' }}">
        <a href="{{ route('dashboard.staf_administrasi.index') }}" class="collapsed">
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

    <li class="nav-item <?php echo isKeywordActive(['staf_pengajar']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#data-sasaran-master-ansit">
            <i class="fas fa-layer-group"></i>
            <p>Data Staf Pengajar</p>
            <span class="caret"></span>
        </a>

        <div class="collapse" id="data-sasaran-master-ansit">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.staf_administrasi.staf_pengajar.index') }}"
                        class="<?php echo isKeywordActive(['staf_pengajar']) ? 'active' : ''; ?>">
                        <span class="sub-item">Manajemen Staf Pengajar</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['siswa']) ? 'active' : ''; ?>">
        <a data-bs-toggle="collapse" href="#siswa">
            <i class="fas fa-layer-group"></i>
            <p>Data Siswa</p>
            <span class="caret"></span>
        </a>

        <div class="collapse" id="siswa">
            <ul class="nav nav-collapse">
                <li>
                    <a href="{{ route('dashboard.staf_administrasi.siswa.index') }}" class="<?php echo isKeywordActive(['siswa']) ? 'active' : ''; ?>">
                        <span class="sub-item">Manajemen Data Siswa</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['mata_pelajaran']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.staf_administrasi.mata_pelajaran.index') }}" class="collapsed">
            <i class="fas fa-layer-group"></i>
            <p>Mata Pelajaran</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['materi_pembelajaran']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.staf_administrasi.materi_pembelajaran.index') }}" class="collapsed">
            <i class="fas fa-layer-group"></i>
            <p>Materi Pembelajaran</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['jadwal_belajar']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.staf_administrasi.jadwal_belajar.index') }}" class="collapsed">
            <i class="fas fa-layer-group"></i>
            <p>Jadwal Belajar</p>
        </a>
    </li>

    <li class="nav-item <?php echo isKeywordActive(['information']) ? 'active' : ''; ?>">
        <a href="{{ route('dashboard.staf_administrasi.information.index') }}" class="collapsed">
            <i class="fas fa-layer-group"></i>
            <p>Informasi</p>
        </a>
    </li>

</ul>
