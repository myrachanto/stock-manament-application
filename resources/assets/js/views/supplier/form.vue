<template>
<div class="panel panel-default">
<div class="panel-heading">
<span class="panel-title">{{title}}</span>
<div align="right">
<router-link to="/supplier/invoice"><button class="btn btn-info btn-sm">Invoices</button></router-link>
<button class="btn btn-info btn-sm" >Pdf</button>
<button class="btn btn-info btn-sm">Excel</button>
<button class="btn btn-danger btn-sm" @click="remove">delete</button>

	</div>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-4">
        <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" v-model="form.name">
        <option>Select</option>
        <option v-for="supplier in option.suppliers" :value="supplier.id">
        {{supplier.company}}/{{supplier.name}}</option>
        </select>
        <span class="alert-danger" v-if="errors.name">{{errors.name[0]}}</span>
        </div>

        <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" v-model="form.title">
        <span class="alert-danger" v-if="errors.title">{{errors.title[0]}}</span>
        </div>
        </div>
         <div class="col-sm-4">
         
        <div class="form-group">
        <label>Dated</label>
        <input type="date" class="form-control" v-model="form.date">
        <span class="alert-danger" v-if="errors.date">{{errors.date[0]}}</span>
        </div>
        <div class="form-group">
        <label> Due Date</label>
        <input type="date" class="form-control" v-model="form.due_date">
        <span class="alert-danger" v-if="errors.due_date">{{errors.due_date[0]}}</span>
        </div>

        </div>
        <div class="col-sm-4">
        <div class="form-group">
        <label>Address</label>
        <textarea class="form-control" v-model="form.address"></textarea>
        <span class="alert-danger" v-if="errors.address">{{errors.address[0]}}</span>
        </div>
        </div>
    </div>
<table class="table table-striped table-bordered">
<thead><tr>
<th>Name</th>
<th>Descripton</th>
<th>Unit Price</th>
<th>Qty</th>
<th>Sub Total</th>
<th>Discount</th>
<th>Vat</th>
<th>Amount</th></tr>
</thead>
<tbody>
<tr v-for="item in form.items">
<td><option>Select</option>
        <option v-for="product in option.products" :value="product.id">
        {{product.name}}</option>
        </select> </td>
<td><input type="text"  class="form-control" v-model="item.description"> </td>
<td><input type="text"  class="form-control" v-model="item.unit_price"> </td>
<td><input type="text" class="form-control" v-model="item.qty"> </td>
<td>{{parseFloat(item.qty) * parseFloat(item.unit_price)}} </td>
<td><input type="text"  class="form-control" v-model="item.discount"> </td>
<td><input type="text" class="form-control" v-model="item.vat"> </td>
<td>{{Amount}}</td>
<td><button @click="form.items.splice(item, 1)">&times;</button></td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="3"> <button type="button" @click="AddProduct()" class="btn btn-primary">Add Product</button>
</td>
<td colspan="3">Sub Total</td>
<td colspan="3">{{SubTotal}}</td>
</tr><tr>
<td colspan="3">
</td>
<td colspan="3">Discount</td>
<td colspan="3">{{Disc}}</td>
</tr><tr>
<td colspan="3">
</td>
<td colspan="3">VAT</td>
<td colspan="3">{{VAT}}</td>
</tr><tr>
<td colspan="3">
</td>
<td colspan="3">Total</td>
<td colspan="3">{{Total}}</td>
</tr>
</tfoot>
</table>
<button @click="save()" class="btn btn-succes">save</button>
</div>
</div>

</template>
<script>
  		import Vue from 'vue'
  		import axios from 'axios'
     import router from 'vue-router'

export default {
name: 'SupplierInvoice',
data(){
    return{
        form:{
            items:[]
        }, 
        errors:{},
        option:{
            suppliers:[],
            products:[]
        },
        title: 'New Invoice',
        initialize: 'http://localhost/stock/public/api/sinvoice/create',
        redirect: 'http://localhost/stock/public/api/sinvoice',
        store: 'http://localhost/stock/public/api/sinvoice',
        method: 'post',
    }
},
beforeMount(){
    this.fetchData()
},
watch:{
    '$route': 'fetchData'
},
computed:{
    subTotal(){
        return this.form.items.reduce(function(carry, item){
            return carry + parseFloat(item.qty) * parseFloat(item.unit_price) - this.discount + this.vats
          

        }, 0)
    },
    Amount(){
            return parseFloat(item.qty) * parseFloat(item.unit_price) - this.discount 
             + this.vats

    },
    vats(){
            return parseFloat(item.qty) * parseFloat(item.unit_price) - this.discount  * parseFloat(item.vat)
        
    },
    discount(){
            return parseFloat(item.qty) * parseFloat(item.unit_price) * parseFloat(item.dicsount)
        
    },
    Disc(){
        return this.form.items.reduce(function(carry, item){
            return carry + this.discount  
        
        }, 0)
    },
    
    VAT(){
        return this.form.items.reduce(function(carry, item){
            return carry + this.vats
            

        }, 0)
    },
    Total(){
            return this.subtotal - this.Disc + this.VAT
        
    }
},
methods:{
    remove(){

    },
    AddProduct(){
        this.form.items.push({
            name: '',
            description: '',
            unit_price: 0,
            qty: 1,
            discount: 0,
            vat: 0
        })
    },
    fetchData(){
        var vm = this
        axios.get(this.initialize)
            .then(function(response){
                Vue.set(vm.$data, 'form', response.data.form)
                Vue.set(vm.$data, 'option', response.data.option)
            })
            .catch(error => {
                    this.errors = [];
                    if (error.response.status = 422){
                        this.errors = error.response.data;
                    }
            });
    },
    save(){
        var vm = this
        axos[this.method](this.store, this.form)
            .then(function(response){
                if(response.data.saved){
                    vm.$router.push(vm.redirect)
                }
            })
    }
}

}

</script>