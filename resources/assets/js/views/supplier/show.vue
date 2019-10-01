<template>
<div class="panel panel-default">
<div class="panel-heading">
<span class="panel-title">{{model.title}}</span><div align="right">
<router-link to="/supplier/invoice"><button class="btn btn-info btn-sm">Invoices</button></router-link>
<button class="btn btn-info btn-sm" >Pdf</button>
<button class="btn btn-info btn-sm">Excel</button>
<router-link to="/supplier/invoice/create"><button class="btn btn-info btn-sm">New Invoice</button></router-link>
	<button class="btn btn-default btn-sm" @click="showFilter = !showFilter">Search</button>

	</div>
</div>
<div class="panel-body">
    <div class="row"> 
        <div class="col-sm-4">
        <label>Supplier</label>
        <p>{{model.supplier.name}}</p>
        <label>Sub Total</label>
        <p>{{model.sub_total}}</p>
        <label>Discount</label>
        <p>{{model.discount}}</p>
        <label>Total</label>
        <p>{{model.total}}</p>
        </div>
         <div class="col-sm-4">
        <label>Company</label>
        <p>{{model.supplier.company}}</p>
        <label>Date</label>
        <p>{{model.date}}</p>
        <label>Due Date</label>
        <p>{{model.due_date}}</p>
        </div>
         <div class="col-sm-4">
        <label>Title</label>
        <p>{{model.title}}</p>
        <label>Phone</label>
        <p>{{model.supplier.phone}}</p>
        <label>Address</label>
        <p>{{model.supplier.address}}</p>
        </div>
    </div>
<table class="table table-striped table-bordered">
<thead><tr>
<th>Title</th>
<th>Descripton</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>Sub Total</th>
<th>Discount</th>
<th>Vat</th>
<th>Amount</th></tr>
</thead>
<tbody>
<tr v-for="item in model.items">
<td>{{item.title}}</td>
<td>{{item.description}}</td> 
<td>{{item.unit_price}}</td>
<td>{{item.qty}}</td>
<td>{{item.sub_total}}</td>
<td>{{item.discount}}</td>
<td>{{item.vat}}</td>
<td>{{item.total}}</td>
</tr>
<tr>
<td colspan="5"></td>
<td colspan="2">Sub Total</td>
<td>{{model.sub_total}}</td>
</tr>
<tr>
<td colspan="5"></td>
<td colspan="2">Discount</td>
<td>{{model.discount}}</td>
</tr>
<tr>
<td colspan="5"></td>
<td colspan="2">Vat</td>
<td>{{model.vat}}</td>
</tr>
<tr>
<td colspan="5"></td>
<td colspan="2">Total</td>
<td>{{model.total}}</td>
</tr>
</tbody>

</table>
</div>
</div>
     
</template>
<script>

  		import Vue from 'vue'
  		import axios from 'axios'
     import router from 'vue-router'

export default {
	name: 'ShowInvoice',
    data(){
        return{
            model:{
                customer: {},
                items:[]
            },
			source: 'http://localhost/stock/public/api/sinvoice',
        }

    },
    beforeMount(){
        this.fetchData()
    },
    methods:{
        fetchData(){
            var vm = this
            axios.get(`http://localhost/stock/public/api/sinvoice/${this.$route.params.id}`)
                .then(function(response){
                    Vue.set(vm.$data, 'model', response.data.model)

                })
                .catch(function(error){
                    console.log(error)
                })
        }

    }
}

    
</script>
