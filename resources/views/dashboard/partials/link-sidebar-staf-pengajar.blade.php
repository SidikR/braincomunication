<ul class="nav nav-secondary">

     <li class="nav-item {{ request()->is('dashboard/staf_pengajar/*') ? '' : 'active' }}">
         <a href="{{ route('dashboard.staf_pengajar.index') }}" class="collapsed">
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

     <li class="nav-item <?php echo isKeywordActive(['jadwal_belajar']) ? 'active' : ''; ?>">
         <a href="{{ route('dashboard.staf_pengajar.jadwal_belajar.index') }}" class="collapsed">
             <i class="fas fa-database"></i>
             <p>Jadwal Belajar</p>
         </a>
     </li>

     <li class="nav-item <?php echo isKeywordActive(['informasi']) ? 'active' : ''; ?>">
         <a href="{{ route('dashboard.staf_pengajar.informasi.index') }}" class="collapsed">
             <i class="fas fa-database"></i>
             <p>Informasi</p>
         </a>
     </li>

     
 </ul>

