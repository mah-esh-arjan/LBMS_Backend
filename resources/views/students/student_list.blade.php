<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-dark font-weight-bold">List of Students</h1>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="thead-dark text-white" style="background-color: #343a40;">
                        <tr>
                            <th scope="col" class="font-weight-bold">Student ID</th>
                            <th scope="col" class="font-weight-bold">Name</th>
                            <th scope="col" class="font-weight-bold text-center">Image</th>
                            <th scope="col" class="font-weight-bold">Age</th>
                            <th scope="col" class="font-weight-bold">Gender</th>
                            <th scope="col" class="font-weight-bold">Course</th>
                            <th scope="col" class="font-weight-bold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $stu)
                        <tr class="border-left border-primary" style="border-left-width: 4px !important;">
                            <td class="font-weight-medium">{{ $stu->student_id }}</td>
                            <td class="font-weight-medium">{{ $stu->name }}</td>
                            <td class="text-center">
                                <img src="{{ asset('images/'. $stu->image_path) }}" 
                                     alt="{{ $stu->name }}'s photo" 
                                     class="img-thumbnail rounded" 
                                     style="width: 60px; height: 60px; object-fit: cover;"
                                     onerror="this.src='https://via.placeholder.com/60?text=No+Image'">
                            </td>
                            <td>{{ $stu->age }}</td>
                            <td>
                                <span class="badge badge-info px-2 py-1">
                                    {{ ucfirst($stu->gender) }}
                                </span>
                            </td>
                            <td>{{ $stu->course }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="edit-student/{{ $stu->student_id }}" 
                                       class="btn btn-outline-primary btn-sm" 
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="delete-student/{{ $stu->student_id }}" 
                                       class="btn btn-outline-danger btn-sm" 
                                       title="Delete"
                                       onclick="return confirm('Are you sure you want to delete {{ addslashes($stu->name) }}?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-light text-muted small">
            <em>Tip: Click the edit or delete buttons to manage student records.</em>
        </div>
    </div>
</div>

<!-- Optional: Include jQuery and Popper.js if needed for modals/tooltips -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>