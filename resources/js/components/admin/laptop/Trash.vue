<template>
	<div class="container">
		<loader v-if='loading'></loader>	
		<div class="row">
			<div class="col-md-12">
				
				<!-- create new brand -->
				<a :href="laptop_url">
					<button class="btn btn-primary btn-blue font-white  mr-2">
						<i class="fas fa-arrow-left mr-2"></i>
						Back to laptops page
					</button>
				</a>

			</div>
		</div>

		<!-- laptop listing -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Laptops</h3>
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
								<th>Image</th>
								<th>Name</th>
								<th>Brand</th>
								<th>Price</th>
								<th>Modify</th>
							</thead>
							<tbody v-if='!laptopCount'>
								<tr>
									<td colspan="5">Sorry ! no data found..</td>
								</tr>
							</tbody>
							<tbody v-else>
								<tr v-for='laptop in laptops.data' :key='laptop.id'>
									<td>
										<img :src="'/images/laptops/'+ imagefolder(laptop.name) + '/'+ laptop.featured_image" alt="" style='width:100px'>
									</td>
									<td>{{ laptop.name }}</td>
									<td  v-for='brand in laptop.laptopbrand'>
										{{ brand.name }}
									</td>
									<td>
										{{ laptop.price | dollar }}
									</td>
									<td>
										<button class="btn btn-info btn-blue font-white mr-2" @click.prevent='restore(laptop.id)'><i class="fas fa-recycle mr-2 "></i>Restore</button>
		             		<button class="btn btn-danger btn-red" ><i class="fa fa-trash mr-2"></i>Delete</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end laptop listing -->
	</div>
</template>
<script>
	export default{
		props:['laptop_url'],
		data(){
			return{
				loading:false,
				laptops:{},
				laptopCount:'',
				form:new Form({}),
			}
		},
		methods:{
			imagefolder(string){
				return string.replace(/\s/g,'_');
			},
			loadLaptops(){
				this.form.get(this.laptop_url+'/trashed-laptop/').then(({data})=>{
					this.laptops=data;
					let alllaptop=data.data;
					this.laptopCount=alllaptop.length;
				});
			},
			restore(id){
				this.loading=true;
				axios.get(this.laptop_url+'/restore/'+id).then(()=>{
					Toast.fire({
            icon: 'success',
            title: 'Laptop restored successfully'
          });
          this.loadLaptops();
          this.loading=false;
				})
			}
		},
		created(){
			this.loadLaptops();
		}
	}
</script>
<style scoped>
	
</style>