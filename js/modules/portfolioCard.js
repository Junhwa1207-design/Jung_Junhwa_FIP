export default {
    Name: "portfolioCard",

    props: ["folio"],

    // data needs to be a function inside a component
    data: 
    
    function() {
        return {
            myName: this.folio.name,
            //myPrice: this.folio.price,
            program: "IDP",
            removeAformat: true,
            showBioData: false
        }
    },

    template: 
    `<li @click="logClicked">
        <img :src="'images/' + folio.image" :alt='folio.name + " image"'>
        <p>{{ folio.name }}</p>
            

        <a @click.prevent="logClicked" href="" class="remove-folio">More Info <!--{{ folio.name }}'s info--></a>                 
        <!--<a href="" class="remove-folio">Remove {{ folio.name }}</a>-->
    </li>`,

    created: function () {
       console.log(`created ${this.folio.name}'s card`);
    },

    methods: {
        logClicked() {
            console.log(`fired from inside ${this.folio.image}'s component!`);
            this.$emit("showmydata", this.folio)
        }

        // removeMiniCooper(target) {
        //    // remove this prof from the professors array
        //    console.log('clicked to remove miniCooper', target, target.name);
        //     //the "this" keyword inside a vue instance REFERS to the Vue instance itself by default
        //     this.showBioData = this.showBioData ? false : true;
        // },

        // showPortfolio(target) {
        //     console.log('clicked to view miniCooper bio data', target.name);
        //     this.showBioData = this.showBioData ? false : true;
        //     this.showBioData = target;
        //     }

        
    }
}