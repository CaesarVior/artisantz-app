const USER_KEY = "users";

const ROLE_KEY = "roles";

let currentUserId = null;

let deleteUserId = null;

let currentRoleId = null;

let deleteRoleId = null;

/*default rolw*/

function defaultRoles(){

    return [

        {

            id:1,

            name:"ADMIN",

            permission:"Full Access",

            active:true

        },

        {

            id:2,

            name:"STAFF",

            permission:"Limited Access",

            active:true

        }

    ];

}

/*d user*/

function defaultUsers(){

    return [

        {

            id:1,

            name:"kinza",

            email:"kinza@gmail.com",

            password:"12345678",

            role:"ADMIN",


        },

        {

            id:2,

            name:"bryan",

            email:"bryan@gmail.com",

            password:"12345678",

            role:"STAFF",


        }

    ];

}

/*rol storage*/

function getRoles(){

    let roles = JSON.parse(

        localStorage.getItem(ROLE_KEY)

    );

    if(!roles){

        roles = defaultRoles();

        saveRoles(roles);

    }

    return roles;

}

function saveRoles(roles){

    localStorage.setItem(

        ROLE_KEY,

        JSON.stringify(roles)

    );

}

/*user penyimpanan*/

function getUsers(){

    let users = JSON.parse(

        localStorage.getItem(USER_KEY)

    );

    if(!users){

        users = defaultUsers();

        saveUsers(users);

    }

    return users;

}

function saveUsers(users){

    localStorage.setItem(

        USER_KEY,

        JSON.stringify(users)

    );

}

/*modal*/

function showModal(id){

    const modal = document.getElementById(id);

    if(modal){

        modal.classList.add("active");

    }

}

function hideModal(id){

    const modal = document.getElementById(id);

    if(modal){

        modal.classList.remove("active");

    }

}

/*user m*/

window.openAddModal=function(){

    showModal("addModal");

}

window.closeAddModal=function(){

    hideModal("addModal");

}

window.openEditModal=function(){

    showModal("editModal");

}

window.closeEditModal=function(){

    hideModal("editModal");

}

window.openDeleteModal=function(){

    showModal("deleteModal");

}

window.closeDeleteModal=function(){

    hideModal("deleteModal");

}

/*role m*/

window.openRoleAddModal=function(){

    showModal("roleAddModal");

}

window.closeRoleAddModal=function(){

    hideModal("roleAddModal");

}

window.openRoleEditModal=function(){

    showModal("roleEditModal");

}

window.closeRoleEditModal=function(){

    hideModal("roleEditModal");

}

window.openRoleDeleteModal=function(){

    showModal("roleDeleteModal");

}

window.closeRoleDeleteModal=function(){

    hideModal("roleDeleteModal");

}

/*render role op*/

function renderRoleOptions(){

    const addRole=document.getElementById("userRole");

    const editRole=document.getElementById("editUserRole");

    if(!addRole || !editRole) return;

    addRole.innerHTML="";

    editRole.innerHTML="";

    getRoles().forEach(role=>{

        if(!role.active) return;

        addRole.innerHTML+=`

<option value="${role.name}">

${role.name}

</option>

`;

        editRole.innerHTML+=`

<option value="${role.name}">

${role.name}

</option>

`;

    });

}

/*r user table*/

function renderUserTable(){

    const tbody=document.getElementById("userTable");

    if(!tbody) return;

    tbody.innerHTML="";

    const users=getUsers();

    users.forEach((user,index)=>{

        tbody.innerHTML+=`

<tr>

<td>${index+1}</td>

<td>${user.name}</td>

<td>${user.email}</td>

<td>

<span class="admin-role">

${user.role}

</span>

</td>

<td>

<div class="admin-actions">

<button

class="admin-edit"

onclick="editUser(${user.id})">

✏

</button>

<button

class="admin-delete"

onclick="deleteUser(${user.id})">

🗑

</button>

</div>

</td>

</tr>

`;

    });

}

window.saveUser=function(){

    const name=document.getElementById("userName");

    const email=document.getElementById("userEmail");

    const password=document.getElementById("userPassword");

    const role=document.getElementById("userRole");

    let valid=true;

    if(name.value.trim()==""){

        document.getElementById("nameError").classList.add("show");

        valid=false;

    }else{

        document.getElementById("nameError").classList.remove("show");

    }

    if(email.value.trim()==""){

        document.getElementById("emailError").classList.add("show");

        valid=false;

    }else{

        document.getElementById("emailError").classList.remove("show");

    }

    if(password.value.trim()==""){

        document.getElementById("passwordError").classList.add("show");

        valid=false;

    }else{

        document.getElementById("passwordError").classList.remove("show");

    }

    if(!valid) return;

    const users=getUsers();

    users.push({

        id:Date.now(),

        name:name.value,

        email:email.value,

        password:password.value,

        role:role.value,


    });

    saveUsers(users);

    renderUserTable();

    name.value="";

    email.value="";

    password.value="";

    role.selectedIndex=0;

    closeAddModal();

}

window.editUser=function(id){

    const users=getUsers();

    const user=users.find(u=>u.id===id);

    if(!user) return;

    currentUserId=id;

    document.getElementById("editUserName").value=user.name;

    document.getElementById("editUserEmail").value=user.email;

    document.getElementById("editUserPassword").value=user.password;

    document.getElementById("editUserRole").value=user.role;

    openEditModal();

}

window.updateUser=function(){

    const users=getUsers();

    const user=users.find(u=>u.id===currentUserId);

    if(!user) return;

    user.name=document.getElementById("editUserName").value;

    user.email=document.getElementById("editUserEmail").value;

    user.password=document.getElementById("editUserPassword").value;

    user.role=document.getElementById("editUserRole").value;

    saveUsers(users);

    renderUserTable();

    closeEditModal();

}

window.deleteUser=function(id){

    deleteUserId=id;

    openDeleteModal();

}

window.confirmDeleteUser=function(){

    let users=getUsers();

    users=users.filter(user=>user.id!==deleteUserId);

    saveUsers(users);

    renderUserTable();

    closeDeleteModal();

}

function searchUser(){

    const input=document.getElementById("searchUser");

    if(!input) return;

    input.addEventListener("keyup",function(){

        const keyword=this.value.toLowerCase();

        document.querySelectorAll("#userTable tr").forEach(row=>{

            row.style.display=row.innerText
            .toLowerCase()
            .includes(keyword)

            ?

            ""

            :

            "none";

        });

    });

}

function renderRoleTable(){

    const tbody=document.getElementById("roleTable");

    if(!tbody) return;

    tbody.innerHTML="";

    getRoles().forEach((role,index)=>{

        tbody.innerHTML+=`

<tr>

<td>${index+1}</td>

<td>

<span class="admin-role">

${role.name}

</span>

</td>

<td>${role.permission}</td>

<td>

<label class="admin-switch">

<input

type="checkbox"

${role.active ? "checked" : ""}

onchange="toggleRole(${role.id})">

<span class="admin-slider"></span>

</label>

</td>

<td>

<div class="admin-actions">

<button

class="admin-edit"

onclick="editRole(${role.id})">

✏

</button>

<button

class="admin-delete"

onclick="deleteRole(${role.id})">

🗑

</button>

</div>

</td>

</tr>

`;

    });

}

window.saveRole=function(){

    const roleName=document.getElementById("roleName");

    const permission=document.getElementById("permissionSelect");

    if(roleName.value.trim()==""){

        document.getElementById("roleError").classList.add("show");

        return;

    }

    document.getElementById("roleError").classList.remove("show");

    const roles=getRoles();

    roles.push({

        id:Date.now(),

        name:roleName.value,

        permission:permission.value,

        active:true

    });

    saveRoles(roles);

    renderRoleTable();

    renderRoleOptions();

    roleName.value="";

    permission.selectedIndex=0;

    closeRoleAddModal();

}

window.editRole=function(id){

    const roles=getRoles();

    const role=roles.find(r=>r.id===id);

    if(!role) return;

    currentRoleId=id;

    document.getElementById("editRoleName").value=role.name;

    document.getElementById("editPermission").value=role.permission;

    openRoleEditModal();

}

window.updateRole=function(){

    const roles=getRoles();

    const role=roles.find(r=>r.id===currentRoleId);

    if(!role) return;

    role.name=document.getElementById("editRoleName").value;

    role.permission=document.getElementById("editPermission").value;

    saveRoles(roles);

    renderRoleTable();

    renderRoleOptions();

    renderUserTable();

    closeRoleEditModal();

}

window.deleteRole=function(id){

    deleteRoleId=id;

    openRoleDeleteModal();

}

window.confirmDeleteRole=function(){

    let roles=getRoles();

    roles=roles.filter(role=>role.id!==deleteRoleId);

    saveRoles(roles);

    renderRoleTable();

    renderRoleOptions();

    renderUserTable();

    closeRoleDeleteModal();

}

window.toggleRole=function(id){

    const roles=getRoles();

    const role=roles.find(r=>r.id===id);

    if(!role) return;

    role.active=!role.active;

    saveRoles(roles);

    renderRoleTable();

    renderRoleOptions();

}

function searchRole(){

    const input=document.getElementById("searchRole");

    if(!input) return;

    input.addEventListener("keyup",function(){

        const keyword=this.value.toLowerCase();

        document.querySelectorAll("#roleTable tr").forEach(row=>{

            row.style.display=row.innerText
                .toLowerCase()
                .includes(keyword)

                ?

                ""

                :

                "none";

        });

    });

}

window.addEventListener("DOMContentLoaded",function(){

    renderUserTable();

    renderRoleTable();

    renderRoleOptions();

    searchUser();

    searchRole();

});