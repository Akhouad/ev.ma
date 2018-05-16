<div class="sidebar-heading">utilisateurs prés de vous</div>
<div v-if="users.length == 0"><user-skeleton v-for="index in 5" :index="index" /></div>
<ul class="sidebar-users" v-if="users.length > 0">
    <li v-for="u in users" v-cloak>
        <div class="user-info">
            <a href="">
                <img :src="'/storage/images/avatars/' + u.avatar" alt="">
                <p class="fullname" v-text="u.fullname"></p>
                <p class="username" v-text="u.username"></p>
            </a>
        </div>
        <div class="user-actions">
            <a href="" class="btn btn-danger btn-sm">x</a>
        </div>
    </li>
</ul>