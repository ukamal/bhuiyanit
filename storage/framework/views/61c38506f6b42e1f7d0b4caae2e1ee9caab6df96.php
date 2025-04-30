<div class="sidebar-panel bg-white">
   <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center">
      <img class="pl-3" src="<?php echo e(asset('backend/dist-assets/images/logo.jpeg')); ?>" alt="alt" />
      <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
      <div class="sidebar-compact-switch ml-auto"><span></span></div>
   </div>
   <!--  user -->
   <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
      <div class="side-nav">
         <div class="main-menu">
            <ul class="metismenu" id="menu">
               <li class="Ul_li--hover "><a class="" href="<?php echo e(route('admin.dashboard')); ?>"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Dashboard</span></a></li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Stock</span></a>
                  <ul class="mm-collapse">
                     <!-- <li class="item-name"><a class="open" href="<?php echo e(route('admin.stock.add')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Add New Stock</span></a></li> -->
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.add.stock.list')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Stock List</span></a></li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted">
                  </i><span class="item-name text-15 text-muted">Purchase </span></a>
                  <ul class="mm-collapse">
                     <li class="item-name">
                        <a class="open" href="<?php echo e(route('admin.purchase.add')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Add New Purchase</span>
                        </a>
                     </li>
                     <li class="item-name">
                        <a class="open" href="<?php echo e(route('purchase_sale_list')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Purchase List</span></a>
                     </li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                  <span class="item-name text-15 text-muted">Sales</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name">
                        <a class="open" href="<?php echo e(route('admin.sales.add')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Add New Sales</span>
                        </a>
                     </li>
                     <li class="item-name">
                        <a class="open" href="<?php echo e(route('admin.sales.list')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Sales List</span>
                        </a>
                     </li>
                     <li class="item-name">
                        <a class="open" href="<?php echo e(route('sale_return')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Sales Return</span>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Qoutation</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.qoutation.add')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Service Qoutation</span></a>
                     </li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.qoutation.list')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Service Qoutation List</span></a>
                     </li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('item_qoutation_add')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Item Qoutation</span></a>
                     </li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('item_qoutation_list')); ?>">
                        <i class="nav-icon i-File-Horizontal"></i><span class="item-name">Item List</span></a>
                     </li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Service Sales</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.service_sales.add')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Create Service Sales</span></a></li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.service_sales.list')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Service Sales List</span></a></li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Bank</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.bank')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Bank List</span></a></li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.bank.transaction')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Bank Transaction</span></a></li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Expense</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.expense')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Expense Add</span></a></li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.daily.expense')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Daily Expense List</span></a></li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i>
                  <span class="item-name text-15 text-muted">Products</span>
                  </a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('view_brand')); ?>"><i class="nav-icon i-File-Horizontal"></i>
                        <span class="item-name">Brand Manage</span></a>
                     </li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.index')); ?>"><i class="nav-icon i-File-Horizontal"></i>
                        <span class="item-name">Add New Product</span></a>
                     </li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('add.new.category')); ?>"><i class="nav-icon i-File-Horizontal"></i>
                        <span class="item-name">Add new Category</span></a>   
                     </li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Customer</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('customer.index')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Customers</span></a></li>
                     
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.customer.order.list')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Order List</span></a></li>
                     
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.customer.receive.payment')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Receive Payment</span></a></li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.customer.receive.report')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Receive Report </span></a></li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Supplier</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('supplier.index')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Suppliers</span></a></li>
                     
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.supplier.order.list')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Order List</span></a></li>
                     
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.supplier.payment.index')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Supplier Payment </span></a></li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('admin.payment.report')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Payment Report </span></a></li>
                  </ul>
               </li>
               <li class="Ul_li--hover ">
                  <a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Setup Package</span></a>
                  <ul class="mm-collapse">
                     <li class="item-name"><a class="open" href="<?php echo e(route('add.new.package')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Add New Package</span></a></li>
                     <li class="item-name"><a class="open" href="<?php echo e(route('add.new.service')); ?>"><i class="nav-icon i-File-Horizontal"></i><span class="item-name">Add New Service</span></a></li>
                  </ul>
               </li>
               <br><br><br><br><br>
            </ul>
         </div>
      </div>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
         <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
      </div>
      <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
         <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
      </div>
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
         <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
      </div>
      <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
         <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
      </div>
   </div>
   <!--  side-nav-close -->
</div><?php /**PATH /home/user/remote/webbysys/bhuiyanit/resources/views/layouts/backend/parts/left_sidebar.blade.php ENDPATH**/ ?>