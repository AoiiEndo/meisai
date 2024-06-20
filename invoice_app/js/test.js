Vue.createApp({
    data() {
        return{
            text1: '---'
        };
    },
    methods: {
        change(){
            return{
                text1: ''
            };
        }
    }
}).mount('#1');

Vue.createApp({
    blur(){
        return{
            text2: '---'
        };
    },
    methods: {
        blur(){
            return{
                text2: ''
            };
        }
    }
}).mount('2');

Vue.createApp({
    mousemove(){
        return{
            text3: '---'
        };
    },
    methods: {
        mousemove(){
            return{
                text3: ''
            };
        }
    }
}).mount("#3");