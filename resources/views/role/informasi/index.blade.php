@extends('dashboard.layouts.main')
@section('content')
    <div class="page-inner">

        {{-- Breadcrumbs --}}
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard.' . Auth::user()->role . '.index') }}">
                        <i class="icon-home text-primary"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{ $data['page_name'] ?? '' }}</a>
                </li>
            </ul>
        </div>

        {{-- Konten --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Tabel {{ $data['page_name'] ?? '' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="informationTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data akan diisi via JS --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {

            // Inisialisasi DataTable
            const table = $('#informationTable').DataTable({
                ajax: {
                    url: "{{ route('dashboard.notifications') }}",
                    dataSrc: '',
                    error: function(xhr, status, error) {
                        console.error("DataTable AJAX Error:", status, error);
                    }
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            return data ? new Date(data).toLocaleString() : '-';
                        }
                    },
                    {
                        data: 'is_read',
                        render: function(data) {
                            return data ?
                                '<span class="badge bg-success">Sudah Dibaca</span>' :
                                '<span class="badge bg-warning">Belum Dibaca</span>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `<a href="/dashboard/{{ roleName() }}/informasi/${row.id}" class="btn btn-sm btn-primary">Detail</a>`;
                        }
                    }
                ],
                order: [
                    [3, 'desc']
                ], // sort by created_at terbaru
                processing: true,
                serverSide: false,
                responsive: true
            });


            // Fungsi fetch notifikasi & audio
            function fetchNotifications() {
                $.getJSON("{{ route('dashboard.notifications') }}")
                    .done(function(response) {
                        console.log("fetchNotifications response:", response);

                        // Pastikan ambil array
                        let data = response.data || response || [];

                        // Urutkan dari yang terbaru berdasarkan created_at
                        data.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

                        const notifBadge = $('#notifBadge');
                        let newIds = [];
                        let shownIds = JSON.parse(localStorage.getItem('shownNotifs') || "[]");
                        console.log("shownIds from localStorage:", shownIds);

                        // Hitung yang belum dibaca untuk badge
                        const unreadCount = data.filter(d => !d.is_read).length;
                        if (unreadCount > 0) notifBadge.text(unreadCount).show();
                        else notifBadge.hide();

                        data.forEach(info => {
                            if (!shownIds.includes(info.id)) {
                                newIds.push(info.id);
                                if (Notification.permission === "granted") {
                                    const audio = new Audio('/storage/sound/notif.wav');
                                    audio.play().catch(err => console.warn(err));
                                    new Notification(info.title, {
                                        body: info.description || '',
                                        icon: '/assets-dashboard/img/jm_denis.jpg'
                                    });
                                }
                            }
                        });

                        console.log("newIds to add:", newIds);
                        localStorage.setItem('shownNotifs', JSON.stringify([...shownIds, ...newIds]));
                    })
                    .fail(function(xhr, status, error) {
                        console.error("fetchNotifications AJAX failed:", status, error);
                        console.log("Response text:", xhr.responseText);
                    });
            }


            // Panggil pertama kali & set interval
            fetchNotifications();
            setInterval(fetchNotifications, 60000); // tiap 1 menit
        });
    </script>
@endsection
