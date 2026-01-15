@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Danh sách liên hệ</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Ngày</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>
                        <span class="badge bg-{{ $contact->status == 'resolved' ? 'success' : 'warning' }}">
                            {{ $contact->status }}
                        </span>
                    </td>
                    <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ url('/admin/contacts/' . $contact->id) }}" class="btn btn-sm btn-info">Xem</a>
                        <form action="{{ url('/admin/contacts/' . $contact->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}
</div>
@endsection
