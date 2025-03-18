<ul class="list-icon">
    <li title="Hợp đồng cần thu lãi trong ngày">
        <i class="fa fa-clock-o"></i>
        <span class="">{{$interestIsDueCount}}</span>
    </li>
    <li title="Hợp đồng sắp đến hạn thu">
        <i class="fa fa-diamond"></i>
        <span class="">{{$interestIsAboutDueCount}}</span>
    </li>
<!--    <li title="Hợp đồng cần thu lãi trong ngày">
        <i class="fa fa-motorcycle"></i>
        <span class="">0</span>
    </li>-->
    <li title="Hợp đồng thanh lý">
        <i class="fa fa-money"></i>
        <span class="">{{$liquidationIsDueCount}}</span>
    </li>
    <li title="Hợp đồng trễ hẹn">
        <i class="fa fa-bell-o"></i>
        <span class="">{{$interestIsOverDueCount}}</span>
    </li>
</ul>
