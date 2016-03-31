<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Меню</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active">{{link_to('/', $title = 'Головна')}}</li>
            {{--<li><a href="#"><span>Another Link</span></a></li>--}}
            <li class="treeview">
                <a href="#"><span>Клієнт</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>{{link_to('/clients', $title = 'База клієнтів')}}</li>
                    <li>{{link_to('/tickets', $title = 'Абонементи')}}</li>
                    <li>{{link_to('/discounts', $title = 'Знижки')}}</li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><span>Тренування</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>{{link_to('/calendar', $title = 'Графік')}}</li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><span>Налаштування</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>{{link_to('/users', $title = 'Юзери')}}</li>
                    <li>{{link_to('/services', $title = 'Сервіси')}}</li>
                    <li>{{link_to('/role', $title = 'Ролі')}}</li>
                    <li class="treeview">
                        <a href="#"><span>Статуси</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>{{link_to('/clients/statuses', $title = 'Клієнти')}}</li>
                            <li>{{link_to('/tickets/statuses', $title = 'Абонементи')}}</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>{{link_to('/options', $title = 'Система')}}</li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>