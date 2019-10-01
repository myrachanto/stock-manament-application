<template>

<div class="content">
<div class="pannel">
<div class="panel-title">Dashboard</div>

</div>
<div class="card-row">
    <div class="card-item" v-for="card in cards">
        <div class="card-inner">
            <div class="card-title">{{card.title}}</div>
            <div class="card-value" v-if="card.type ==='value'">{{card.value}}</div> 
             
              </div> 
        </div>
    </div>
</div>
</div>
</div>
</template>
<script>
  import axios from 'axios'
export default{

    mounted(){
      axios.get('http://localhost/stock/public/api/dashboard')
        .then((res)=>{
          this.$set(this.$data, 'cards', res.data.cards)
        })

    },
    data(){
        return{
            cards: [],
            values:[1,100]
        } 
    }
}
</script> 