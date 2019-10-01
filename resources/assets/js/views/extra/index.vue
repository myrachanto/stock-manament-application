<template>
<data-viewer :source="source"  :thead="thead" :filter="filter" :create="create" :title="title">
<template slot="create">
<button class="btn btn-info btn-sm" >Pdf</button>
<button class="btn btn-info btn-sm">Excel</button>
<button class="btn btn-info btn-sm" @click="initAddTask()">Create</button>
</template>
<template  slot-scope="{item}">
	<tr >
		<td>{{ item.id}}</td>
		<td>{{ item.company}}</td>
		<td>{{ item.name}}</td>
		<td>{{ item.email}}</td>
		<td>
 <button @click="viewdata(item)" class="btn btn-info btn-xs">view</span></button>
 <button @click="initUpdate(item)" class="btn btn-success btn-xs">edit</span></button>
 <button @click="deleteTask(item)" class="btn btn-danger btn-xs">delete</span></button>
 </td>

</tr>
<div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Task</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="customer.name">
                        </div>
                        <div class="form-group">
                            <label for="company">Company:</label>
                            <input type="text" name="company" id="company" placeholder="company" class="form-control"
                                   v-model="customer.company">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" placeholder="email" class="form-control"
                                   v-model="customer.email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" placeholder="phone" class="form-control"
                                   v-model="customer.phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control"
                                      placeholder="address" v-model="customer.address"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="view_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">View data</h4>
                    </div>
                    <div class="modal-body">
 
                      
 
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <p v-text="cust.name"></p>
                        </div>
                        <div class="form-group">
                            <label for="company">Company:</label>
                            <p v-text="cust.company"></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <p v-text="cust.email"></p>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <p v-text="cust.phone"></p>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <p v-text="cust.address"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Task</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                   v-model="cust.name">
                        </div>
                        <div class="form-group">
                            <label for="company">Company:</label>
                            <input type="text" name="company" id="company" placeholder="company" class="form-control"
                                   v-model="cust.company">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" placeholder="email" class="form-control"
                                   v-model="cust.email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" placeholder="phone" class="form-control"
                                   v-model="cust.phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control"
                                      placeholder="address" v-model="cust.address"></textarea>
                        </div>
 
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTask(cust)" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        

</template>
<router-view></router-view>
</data-viewer>
</template>
<script>
import DataViewer from '../../components/DataViewer.vue'

  		import Vue from 'vue'
  		import axios from 'axios'
     import router from 'vue-router'

export default {
	name: 'customer',
	data(){
		return{
			title: 'Customers',
			source: 'http://localhost/santos/public/api/customer',
            router:{},
            model:{
  						data:[]
  					},
			customer: {
                    name: '',
                    company: '',
                    email: '',
                    phone: '',
                    address:''

                },
                errors: [],
				customers: [],
                cust: {},
                params:{
  					 	page: 1,
						column: 'id',
						direction: 'desc',
						per_page:7,
						search_column: 'id',
  						search_operator:'equal_to',
  						search_query_1:'',
  						search_query_2:'',
						router:{},

  					},
			thead:[
				{title: 'ID', key: 'id', sort: true},
				{title: 'Company', key: 'company', sort: true},
				{title: 'Name', key: 'name', sort: true},
				{title: 'Email', key: 'email', sort: true}
			],

			filter: [
				'id', 'company', 'name', 'email', 'phone', 'address'
			]
		}
	},
    
    components: { DataViewer },
    
        
			  
		 methods: {
             
            initAddTask()
            {
                this.errors = [];
                $("#add_task_model").modal("show");
            },
            createTask()
            {
                axios.post('http://localhost/santos/public/api/customer', {
                    name: this.customer.name,
                    company: this.customer.company,
                    email: this.customer.email,
                    phone: this.customer.phone,
                    address: this.customer.address,
                })
                    .then(response => {
 
                        this.reset();
						 
 
                        $("#add_task_model").modal("hide");
                            this.$router.push('/');
 
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        
                        if (error.response.data.errors.company) {
                            this.errors.push(error.response.data.errors.company[0]);
                        }
                        
                        if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
                        
                        if (error.response.data.errors.phone) {
                            this.errors.push(error.response.data.errors.phone[0]);
                        }
 
                        if (error.response.data.errors.address) {
                            this.errors.push(error.response.data.errors.address[0]);
                        }
                    });
            },
            reset()
            {
                this.customer.name = '';
                this.customer.company = '';
                this.customer.email = '';
                this.customer.phone = '';
                this.customer.address = '';
            },
            
               viewdata(item)
            {
                this.errors = [];
                $("#view_task_model").modal("show");
                this.cust = item;
            },
               initUpdate(item)
            {
                this.errors = [];
                $("#update_task_model").modal("show");
                this.cust = item;
            },
            updateTask(cust)
            {
                axios.patch('http://localhost/santos/public/api/customer/' + cust.id, {
                    name: cust.name,
                    company: cust.company,
                    phone: cust.phone,
                    email: cust.email,
                    address: cust.address,
                })
                    .then(response => {
                         
                        $("#update_task_model").modal("hide");
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
                        
                        if (error.response.data.errors.company) {
                            this.errors.push(error.response.data.errors.company[0]);
                        }
 
                        if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
 
                        if (error.response.data.errors.phone) {
                            this.errors.push(error.response.data.errors.phone[0]);
                        }
 
 
                        if (error.response.data.errors.address) {
                            this.errors.push(error.response.data.errors.address[0]);
                        }
                    });
            },
			deleteTask(item)
            {
                let conf = confirm("Are you ready to delete : " + item.name + " details?");
                if (conf === true) {
 
                    axios.delete('http://localhost/santos/public/api/customer/' + item.id)
                        .then(response => {
 
                            this.$router.push('/')
 
 
                        })
                        .catch(error => {
 
                        });
                }
            },
        
            
         }

}
</script>
