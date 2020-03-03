@if($oModule->parent_id == 0 && $oModule->childs->isEmpty())
<li class="treeview">
    <a href="{{ url('admin/'.$oModule->path) }}">
        <i class="{{ ($oModule->icon)?$oModule->icon: 'fa fa-list'}}"></i> <span> {{ $oModule->title }}</span>
    </a>
</li>
@elseif($oModule->parent_id == 0 && !$oModule->childs->isEmpty())
<li class="treeview">
    <a href="{{ url('admin/'.$oModule->path) }}">
        <i class="{{ ($oModule->icon)?$oModule->icon: 'fa fa-list'}}"></i> <span> {{ $oModule->title }}</span> 
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        @foreach($oModule->childs as $oChildModule)
        <li><a href="{{ url('admin/'.$oChildModule->path) }}"><i class="{{ ($oChildModule->icon)?$oChildModule->icon: 'fa fa-circle-o'}}"></i> <span>{{ $oChildModule->title }}</span></a></li>
        @endforeach
    </ul>
</li>
@endif