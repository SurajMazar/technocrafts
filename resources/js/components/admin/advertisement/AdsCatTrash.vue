<template>
	<div class="container">
		<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
				<a :href="ads_category_url">
				<button class="btn btn-primary btn-blue font-white mr-2" @click='openModal()'>
					<i class="fas fa-arrow-left mr-2"></i>Back to Ads Category
				</button>
				</a>
			</div>
		</div>

		<!-- ads category listing -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Ads Categories</h6>
						<div class="card-tools">
	            <div class="input-group input-group-sm" style="width: 150px;">
	              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
	              <div class="input-group-append">
	                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
	              </div>
	            </div>
	          </div>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
	            <thead>
	              <tr>
	                <th>Name</th>
	                <th>No of ads</th>
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody v-if='!adCatCount'>
	            	<tr>
	            		<td colspan="4">Sorry! no data found.</td>
	            	</tr>
	            </tbody>
	            <tbody v-else>
	            	<tr v-for='(cat, index) in adCats.data' :key='cat.id'>
	            		<td>{{ cat.name }}</td>
	            		<td>{{ cat.ads_category.length }}</td>
	            		<td>
	            			<button class="btn btn-primary btn-blue font-white mr-2" @click='restore(cat.id)'>
	            				<i class="fas fa-recycle mr-2"></i>restore
	            			</button>
	            			<button class="btn btn-danger btn-red mr-2 " >
	            				<i class="fas fa-times mr-2"></i>Delete
	            			</button>
	            		</td>
	            	</tr>
	            </tbody>
	          </table>
					</div>	
					<div class="card-footer">
		        <pagination :data="adCats" @pagination-change-page="getResults"></pagination>
		      </div>	
				</div>
			</div>
		</div>
		<!-- end ads category listing -->

	</div>
</template>
<script>
	export default{
		name:'admin-ads-category-trash',
		props:['ads_category_url'],
		data(){
			return{
				loading:false,
				adCats:{},
				adCatCount:'',
			}
		},
		methods:{
      loadAdscategory(){
      	axios.get(this.ads_category_url+'/trashed/').then(({data})=>{
      		this.adCats=data;
      		let cats=data.data;
      		this.adCatCount=cats.length;
      	}).catch(()=>{
      		Toast.fire({
            icon: 'error',
            title: "Error Fetching Categories"
          })
      	});
      },

      getResults(page = 1) {
        this.loading=true;
        axios.get(this.ads_category_url+'/trashed' +'/?page=' + page)
        .then(response => {
            this.adCats = response.data;
            this.loading=false;
        });
      },

      restore(id){
      	this.loading=true;
      	axios.get(this.ads_category_url+'/restore/'+id).then(()=>{
      		this.loadAdscategory();
      		Toast.fire({
            icon: 'success',
            title: "Ads category restored successfully"
          });
          this.loading=false;
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      }

		},
		created(){
			this.loadAdscategory();
		}
	}
</script>