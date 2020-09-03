<style scoped>
  .input {
    flex: 1;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 6px 8px;
    color: #222;
    font-size: 18px;
  }

  .search-bar {
    display: flex;
  }

  .content {
    margin: 20px auto;
    background-color: white;
    padding: 20px;
    border-radius: 6px;
    max-width: 720px;
    display: flex;
    flex-direction: column;
  }

  .search-button {
    background-color: #4fc08d;
    border: none;
    border-radius: 4px;
    color: white;
    width: 50px;
  }

  .v-icon, .search-icon {
    width: 20px;
  }

  .v-icon, .save-icon {
    width: 28px;
    color: white;
  }

  .grid {
    margin-top: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    justify-items: center;
  }

  .button-group {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
  }

  .card-body {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
  }

  .saved {
    height: 60px;
    width: 60px;
    border-radius: 50%;
    background-color: #416db8;
    position: fixed;
    bottom: 25px; 
    z-index: 10;
    display: flex;
    justify-content: center;
    align-items: center;
    align-self: flex-end;
  }

  @media only screen and (max-width: 770px) {
    .grid {
      grid-template-columns: 1fr;
    }
  }

</style>

<template>
  <div class="container">
    <div class="content">
      <div class="search-bar">
        <input class="input" type="text" v-model="query" placeholder="Nome do repositório"/>                           
        <button v-on:click="searchRepository" class="search-button">
          <div v-if="loading" class="spinner-border spinner-border-sm text-light" role="status">
            <span class="sr-only">Loading...</span>
          </div> 
          <v-icon v-else name="search" base-class="search-icon" />
        </button>
      </div>      
      <button class="btn saved" v-on:click="goToSaved">
        <v-icon name="save" base-class="save-icon" />
      </button>
      <div class="grid">
        <div class="card" style="width: 18rem;" v-for="repository in repositories" :key="repository.id">
          <div class="card-body">
            <div>
              <h5 class="card-title">{{repository.full_name}}</h5>
              <p v-if="descriptionLength(repository.description)<150" class="card-text">{{repository.description}}</p>
              <p v-else class="card-text">{{repository.description.substring(0, 150) + '...'}}</p>
            </div>
            <div class="button-group">
              <a :href="repository.svn_url" target="_blank" class="btn btn-primary">Ir para repositório</a>
              <button 
                class="btn btn-outline-success" 
                v-on:click="saveRepository(repository.full_name, repository.description, repository.svn_url)"
              >
                Salvar
              </button>
            </div>
          </div>
        </div>
      </div>          
    </div>
  </div>
</template>

<script>
  import customIcon from 'vue-icon/lib/vue-feather.esm';

  export default {
    data: function() {
      return {
        query: '',
        loading: false,
        baseClass: 'v-icon',
        repositories: [],
      }
    },

    components: {
      customIcon
    },

    methods: {
      async searchRepository(){
        this.loading = true;
        try{
          let {data} = await axios.get('https://api.github.com/search/repositories', { 
            params: {
              q: this.query,
              per_page: 8,
            }
          });
  
          this.repositories = data.items;
        } catch(err){
          alert('Erro');
        }
        this.loading = false;
      },

      async saveRepository(name, description, url){
        console.log(name, description, url);
        try {
          await axios.post('http://localhost:8000/api/repositories', { 
            name,
            description: description.substring(0, 254),
            url,
          });
          alert('Repositorio salvo');
        } catch(err){
          alert('Erro');
          console.log(err);
        }
      },
      
      descriptionLength(string){
        if(string){
          return string.length;
        }

        return 0;
      },

      goToSaved(){
        this.$router.push('/saved');
      },
    },
  }
</script>
