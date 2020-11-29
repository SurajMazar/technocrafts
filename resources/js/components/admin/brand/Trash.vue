<template>
	<div class="container">
		<!-- buttons -->
		<div class="row">
			<div class="col-md-12">
				
				<!-- back to brand -->
				<a :href="brand_url">
					<button class="btn btn-primary mr-2">
						<i class="fas fa-arrow-left mr-2"></i>
						Back to brands
					</button>
				</a>

			</div>
		</div>
		<!-- end buttons -->

		<!-- brands list -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Brands</h3>
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
				          <th>Logo</th>
				          <th>Name</th>
				          <th>Laptops</th>
				          <th>Smart Phones</th>
				          <th>Action</th>
				        </tr>
				      </thead>
				      <tbody v-if='brandsLength==0'>
				      	<tr>
				      		<td colspan="6">Sorry, no data found!!</td>
				      	</tr>
				      </tbody>
				      <tbody v-else>
				      	<tr v-for='brand in brands.data' :key='brand.id'>
				      		<td style="display: flex;justify-content: center;">
				      			<div class="brandImage">
				      				<img :src="'/images/brands/'+brand.brand_image"  alt="">
				      			</div>
				      		</td>
				      		<td>{{ brand.name }}</td>
				      		<td>0</td>
				      		<td>0</td>
				      		<td>
				      			<button class="btn btn-primary mr-2" @click='restore(brand.id)'><i class="fas fa-recycle mr-1"></i>Restore</button>
				      			<button class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</button>
				      		</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
				</div>
			</div>
		</div>
		<!-- end brand list -->
	</div>
</template>
<script>
	export default{
		props:['brand_url'],
		data(){
			return{
				form:new Form({
					id:'',
					name:'',
					slug:'',
					brand_image:null,
					description:'',
					meta_title:'',
					meta_description:'',
					meta_keyword:'',
				}),
				editMode:false,
				editMode_image:false,
				brands:{},
				brandsLength:'',
			}
		},
		methods:{
      loadBrands(){
      	axios.get(this.brand_url + '/trashed_brands/').then(({data})=>{
      		this.brands=data;
      		let brand=data.data;
      		this.brandsLength=brand.length;
      	})
      },
      restore(id){
      	axios.get(this.brand_url+'/restore/'+id).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Brand restored successfully'
          });
          this.loadBrands();
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
				});
      }
		},
		created(){
			this.loadBrands();
		}
	}
</script>
<style lang="scss" scoped>
	.brandImage{
		width: 100px;
		height: 100px;
		overflow: hidden;
		img{
			width: 100%;
			height: 100%;
			object-fit: cover;
			overflow: hidden;
			transition: all 0.3s ease-in-out;
			&:hover{
				transform: scale(1.1);
			}
		}
	}

</style>