<div>
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if ($beep == true) beep @endif"><i class="far fa-bell"></i></a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
          <div class="dropdown-header">Notifikasi
            {{-- <div class="float-right">
              <a href="#">Mark All As Read</a>
            </div> --}}
          </div>
          <div class="dropdown-list-content dropdown-list-icons">
              @foreach ($datanya as $data)
              @php
                  $textnya = json_decode($data->text);
              @endphp
            <a
            @switch($data->type)
                @case('exportpdf')
                    href="{{ route('pdf',['filenya' => $textnya->lokasi_file]) }}"
                    @break
                @case('exportexcel')
                    href="{{ route('excel',['filenya' => $textnya->lokasi_file]) }}"
                    @break
                @case('notifaduan')
                    href="{{ route('notifAduan',['url' => $textnya->url]) }}"
                    @break
                @case('notifapprov')
                    href="{{ route('notifapprov',['url' => $textnya->url]) }}"
                    @break
                @case('notifreminder')
                    href="{{ route('notifreminder',['url' => $textnya->url]) }}"
                    @break
                @case('notifstatuspending')
                    href="{{ route('notifstatuspending',['url' => $textnya->url]) }}"
                    @break
                @default

            @endswitch
            {{-- wire:click.prevent='test({{$data}})' --}}
            class="dropdown-item  @if ($data->is_read == false) dropdown-item-unread @endif  ">
              <div class="dropdown-item-icon bg-primary text-white">
                <i class="{{ $textnya->icon }}"></i>
              </div>
              <div class="dropdown-item-desc">
                {{ $textnya->text }}
                <div class="time text-primary">{{$data->created_at->diffForHumans()}}</div>
              </div>
            </a>
            @endforeach
            {{-- <a href="#" class="dropdown-item">
              <div class="dropdown-item-icon bg-info text-white">
                <i class="far fa-user"></i>
              </div>
              <div class="dropdown-item-desc">
                Ini yang enggak, bisa diubah itu icon
                <div class="time">10 Hours Ago</div>
              </div>
            </a> --}}

          </div>
          <div class="dropdown-footer text-center">
            <a href="#">Lihat Semua Notifikasi <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
    </li>
    {{-- {!! Toastr::message() !!} --}}
    @laratoast_render
</div>
