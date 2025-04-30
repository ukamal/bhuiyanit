<template>
    <div>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#customerModal">
            Add (+)
        </button>
    
        <div class="modal fade" ref="addCustomerModal"  id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Add Customer</h5>
            </div>
    
                <form  @submit.prevent="submitForm" action="" method="post" ref="addCustomerForm">
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" required class="form-control" name="name"
                                    id="name" aria-describedby="emailHelp" placeholder="">

                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  ref="close_add_author" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    </template>
    
    <script>
        export default {
            name: 'add-new-customer',
            mounted(){
                
            },
            data(){
                return {
                   
                }
            },
            computed: {
               
            },
            methods: {
                submitForm(){
                    let form = this.$refs.addCustomerForm;
                    let formData = new FormData(form);
                    
                    axios.post('/api/customer/store', formData).then(response => {
                        console.log(response);
                        if(response.data.message == "success"){
                            $(this.$refs.close_add_author.click())
                            this.$parent.getAllCustomers();
                            Swal.fire(
                                'Success!',
                                'Customer created successfully!',
                                'success'
                                )
                            // window.location.reload();
                        }
                        this.loading = false;
                    }).catch(error => {
                        console.log(error);
                        if (error.response && error.response.status == 422){
                            this.validationErrors = error.response.data.errors;
                            Swal.fire(
                                    'Error!',
                                    'Something went wrong!',
                                    'error'
                                )  
                        }
                        this.loading = false;
                    });
                }
            }
        }
    </script>
    