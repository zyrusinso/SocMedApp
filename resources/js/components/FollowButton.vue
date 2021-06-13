<template>
    <div class="ml-2">
        <button class="btn btn-primary ml-4 " @click="followUser()" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {

        props: ['user'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return {
                status: this.follows
            }
        },
        methods: {
            followUser(){
                const th = this;
                axios.post('/follow/'+th.user)
                .then(response => {
                    this.status = !this.status;
                    console.log(response.data);
                }).catch(errors => {
                    if(errors.response.status == 401){
                        window.location = "/login";
                    }
                })
                
                
            }
        },

        computed: {
            
            buttonText(){
                ben
                return (this.status)? 'Unfollow' : 'Follow';
            }
        },
    }

    
</script>
