<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Manage Roles</title>

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

                    <a href="{{ url('/admin') }}">

                        Manage Users

                    </a>

                </li>

                <li>

                    <a
                        href="{{ url('/roles') }}"
                        class="active">

                        Manage Roles

                    </a>

                </li>

            </ul>

        </aside>

        <main class="admin-content">

            <h2>

                Manage Roles

            </h2>

            <div class="admin-card">

                <div class="card-header">

                    <h3>

                        Role List

                    </h3>

                    <input
                        type="text"
                        id="searchRole"
                        placeholder="Search">

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Role</th>

                            <th>Permission</th>

                            <th>Switch</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody id="roleTable">

                    </tbody>

                </table>

            </div>

            <button

                class="floating-btn"

                onclick="openRoleAddModal()">

                +

            </button>

        </main>

    </div>

</div>
<!-- add role -->

<div
    class="modal"
    id="roleAddModal">

    <div class="modal-content">

        <h2>

            Add Role

        </h2>

        <div class="form-group">

            <label>

                Role Name

            </label>

            <input
                type="text"
                id="roleName">

            <small
                class="error"
                id="roleError">

                Role is required

            </small>

        </div>

        <div class="form-group">

            <label>

                Permission

            </label>

            <select id="permissionSelect">

                <option>Full Access</option>

                <option>Limited Access</option>

                <option>Read Only</option>

            </select>

        </div>

        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeRoleAddModal()">

                Cancel

            </button>

            <button
                class="btn-save"
                onclick="saveRole()">

                Save

            </button>

        </div>

    </div>

</div>

<!-- edit rol -->

<div
    class="modal"
    id="roleEditModal">

    <div class="modal-content">

        <h2>

            Edit Role

        </h2>

        <div class="form-group">

            <label>

                Role Name

            </label>

            <input
                type="text"
                id="editRoleName">

        </div>

        <div class="form-group">

            <label>

                Permission

            </label>

            <select id="editPermission">

                <option>Full Access</option>

                <option>Limited Access</option>

                <option>Read Only</option>

            </select>

        </div>

        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeRoleEditModal()">

                Cancel

            </button>

            <button
                class="btn-save"
                onclick="updateRole()">

                Save

            </button>

        </div>

    </div>

</div>

<!-- delete rol -->

<div
    class="modal"
    id="roleDeleteModal">

    <div class="modal-content delete-box">

        <h2>

            Delete Role

        </h2>

        <p>

            Are you sure want to delete this role?

        </p>

        <div class="modal-footer">

            <button
                class="btn-cancel"
                onclick="closeRoleDeleteModal()">

                Cancel

            </button>

            <button
                class="btn-delete"
                onclick="confirmDeleteRole()">

                Delete

            </button>

        </div>

    </div>

</div>

@vite('resources/js/admin.js')

</body>

</html>