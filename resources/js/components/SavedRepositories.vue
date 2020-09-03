<style scoped>
  .content {
    margin: 20px auto;
    background-color: white;
    padding: 20px;
    border-radius: 6px;
    max-width: 720px;
    display: flex;
    flex-direction: column;
  }

  .v-icon, .back-icon {
    width: 32px;
    margin-right: 4px;
    color: white;
  }

  .grid {
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

  .back {
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
      <button class="btn back" v-on:click="goback">
        <v-icon name="chevron-left" base-class="back-icon" />
      </button>
      <div class="grid">
        <div class="card" style="width: 18rem;" v-for="(repository, index) in repositories" :key="repository.id">
          <div class="card-body">
            <div>
              <h5 class="card-title">{{repository.name}}</h5>
              <p class="card-text">{{repository.description}}</p>
            </div>
            <div class="button-group">
              <a :href="repository.url" target="_blank" class="btn btn-primary">Ir para repositório</a>
              <button 
                class="btn btn-outline-danger" 
                v-on:click="deleteRepository(repository.id, index)"
              >
                Excluir
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
        baseClass: 'v-icon',
        repositories: [],
      }
    },

    async mounted(){
      let { data } = await axios.get('http://localhost:8000/api/repositories');
      this.repositories = data;
    },

    components: {
      customIcon
    },

    methods: {
      async deleteRepository(repositoryId, repositoryIndex){
        try{
          await axios.delete(`http://localhost:8000/api/repositories/${repositoryId}`);
          this.repositories.splice(repositoryIndex, 1);
        } catch(err){
          console.log(err);
          alert('Erro');
        }
      },
      
      goback(){
        this.$router.push('/');
      },
    },
  }
</script>
