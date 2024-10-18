<div class="card-body">
    <h5 class="card-title">Admins</h5>

    <div class="news">
        @foreach ($admins as $admin)
            <div class="post-item clearfix">
                <img src="/assets/dashboard/img/news-1.jpg" alt="">
                <h4>{{ ucfirst($admin->first_name) }} {{ ucfirst($admin->last_name) }}</h4>
            </div>
        @endforeach
    </div><!-- End sidebar recent posts-->

</div>
