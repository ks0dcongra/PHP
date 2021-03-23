<template>
    <div>
        <div v-for="spot in spots" :key="spot.name">
            <transition name="el-zoom-in-top">
                <SpotItem :spot="spot" :username="username" :degree="degree" :weather="weather"/>
            </transition>

        </div>
    </div>
  
</template>

<script>
import SpotItem from './SpotItem.vue'


export default {
    name:'Spot',
    components: {
        SpotItem
    },
    props:["spots", "username", "degree","weather"]
}
</script>

<style>

</style>