<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Users</title>

    @vite('resources/css/admin.css')

</head>

<body>

<div class="admin-page">

    <header class="admin-header">

        <div class="admin-logo">

            <h2>Artisantz.</h2>

            <small>Admin</small>

        </div>

    </header>

    <div class="admin-body">

        <aside class="admin-sidebar">

            <ul>

                <li>

                    <a
                        href="{{ url('/admin') }}"
                        class="active">

                        Manage Users

                    </a>

                </li>

                <li>

                    <a
                        href="{{ url('/roles') }}">

                        Manage Roles

                    </a>

                </li>

            </ul>

        </aside>

        <main class="admin-content">

            <h2>

                Manage Users

            </h2>

            <div class="admin-card">

                <div class="card-header">

                    <h3>

                        User List

                    </h3>

                    <input

                        type="text"

                        id="searchUser"

                        placeholder="Search">

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Users</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody id="userTable">

                    </tbody>

                </table>

            </div>

            <button

                class="floating-btn"

                onclick="openAddModal()">

                +

            </button>
                    </main>

    </div>

</div>

<!-- add userr -->

<div
    class="modal"
    id="addModal">

    <div class="modal-content">

        <h2>Add User</h2>

        <div class="form-group">

            <label>Name</label>

            <input
                type="text"
                id="userName">

            <small
                class="error"
                id="nameError">

                Name is required

            </small>

        </div>

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                id="userEmail">

            <small
                class="error"
                id="emailError">

                Email is required

            </small>

        </div>

        <div class="form-group">

            <label>Password</label>

            <input
                type="password"
                id="userPassword">

            <small
                class="error"
                id="passwordError">

                Password is required

            </small>

        </div>

        <div class="form-group">

            <label>Role</label>

            <select id="userRole">

            </select>

        </div>

        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeAddModal()">

                Cancel

            </button>

            <button
                class="btn-save"
                onclick="saveUser()">

                Save

            </button>

        </div>

    </div>

</div>
<!-- edit user -->

<div
    class="modal"
    id="editModal">

    <div class="modal-content">

        <h2>Edit User</h2>

        <div class="form-group">

            <label>Name</label>

            <input
                type="text"
                id="editUserName">

        </div>

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                id="editUserEmail">

        </div>

        <div class="form-group">

            <label>Password</label>

            <input
                type="password"
                id="editUserPassword">

        </div>

        <div class="form-group">

            <label>Role</label>

            <select
                id="editUserRole">

            </select>

        </div>

        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeEditModal()">

                Cancel

            </button>

            <button
                class="btn-save"
                onclick="updateUser()">

                Save

            </button>

        </div>

    </div>

</div>
<!-- delete u -->

<div
    class="modal"
    id="deleteModal">

    <div class="modal-content delete-box">

        <h2>

            Delete User

        </h2>

        <p>

            Are you sure want to delete this user?

        </p>

        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeDeleteModal()">

                Cancel

            </button>

            <button
                class="btn-delete"
                onclick="confirmDeleteUser()">

                Delete

            </button>

        </div>

    </div>

</div>

@vite('resources/js/admin.js')

</body>

</html>