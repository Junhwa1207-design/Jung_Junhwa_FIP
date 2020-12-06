import { fetchData} from "./modules/TheDataMiner.js";
import portfolioCard from "./modules/portfolioCard.js";




(()=> {
    let vue_vm = new Vue ({

        data: {
            message: "MINICOOPER EVENT!",
            anotherMessage: "This is some sample text!",
            removeAformat: true,
            showBioData: false,
            portfolio: [ ],
            currentPortfolioData:{}
         
            
        },
        mounted: function(){
            console.log("Vue is mounted, trying a fetch for the initial data");

            fetchData("./includes/index.php")
            .then(data => {
            data.forEach(portfolio => this.portfolio.push(portfolio));
            })
            .catch(err => console.error(err));
     },
     updated: function(){
             console.log ('Vue just updated the DOM');

     },

     methods:{
        logclicked(){
            console.log("clicked on a list item")
        },
        clickHeader() {
            console.log("clicked on the header");
        },

        showPortfolioData (target) {
 
            console.log('clicked to view portfolio bio-data', target, target.name);
      
            this.showBioData = this.showBioData ? false : true;

            this.currentPortfolioData = target;
        }
  
    },
        components: {
            "portfolio-card": portfolioCard   

        }
    }).$mount("#app");
})();

