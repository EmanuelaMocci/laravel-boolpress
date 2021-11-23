<template>
    <main>
        <h1>Main</h1>
        <ul>
            <li v-for="post in posts" :key="post.id">{{post.title}}</li>
        </ul>
    </main>
</template>

<script>
    export default {
        name: "Main",
        data() {
            return {
                posts: []
            }
        },
        mounted(){
            axios.get('/api/posts')
            .then((response) => {
                this.posts = response.data.data;
                console.log(response);
            })
            .catch((error) => {
                console.log(error);
            })
        }
    }
</script>