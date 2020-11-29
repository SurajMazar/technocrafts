<template>
	<div class="container pt-4">
<loader v-if='loading'></loader>
		<div class="row">
			<div class="col-md-12">
				<a href="/admin/smartphones/add" class="btn btn-primart btn-blue font-white mr-2">
					<i class="fas fa-plus mr-1"></i>Add new smartphone
				</a>
				<button class="btn btn-danger btn-red" @click='openTrash'>
					<i class="fas fa-trash mr-1"></i>
					Trash
				</button>
			</div>
		</div>

			<!-- smartphone listing -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Smartphones</h3>
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
							<tbody v-if='!smartphoneCount'>
								<tr>
									<td colspan="5">Sorry ! no data found..</td>
								</tr>
							</tbody>
							<tbody v-else>
								<tr v-for='s in smartphones.data' :key='s.id'>
									<td>
										<img :src="s.images[0]" alt="" style='width:100px'>
									</td>
									<td>{{ s.name }}</td>
									<td>
										{{ s.brand.name }}
									</td>
									<td>
										{{ s.price | dollar }}
									</td>
									<td>
										<a :href="'/admin/smartphones/edit/'+s.id"><button class="btn btn-info btn-blue font-white mr-2"><i class="fas fa-edit mr-2 "></i>Edit</button></a>
		             		<button class="btn btn-danger btn-red" @click.prevent='trashSmartphone(s.id)'><i class="fa fa-trash mr-2"></i>Trash</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="card-footer">
		        <pagination :data="smartphones" @pagination-change-page="getResults"></pagination>

					</div>
				</div>
			</div>
		</div>
		<!-- end smartphone listing -->

		<div class="modal fade " id="trashSmartphoneBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"  id="exampleModalLongTitle">Trash</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
					<div class="modal-body">
						<TrashSmartphone
						 :trashed='trashed' 
						 :trashCount='trashedCount' 
						 :restore='restore'
						 :getResultsTrashed='getResultsTrashed'
						 ></TrashSmartphone>
					</div>
					 <div class="modal-footer">
			        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
			      </div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import TrashSmartphone from './Trash.vue';
	export default{
		components:{
			TrashSmartphone
		},
		data(){
			return{
				loading:true,
				smartphones:{},
				smartphoneCount:'',
				trashed:{},
				trashedCount:0,
			}
		},
		methods:{
			openTrash(){
				$('#trashSmartphoneBrand').modal('show')
			},
			loadSmartphone(){
				axios.get('/admin/smartphones/paginated').then(res=>{
					this.smartphones= res.data;
					this.smartphoneCount=this.smartphones.data.length
					this.loading=false
				})
			},
			loadTrashed(){
				axios.get('/admin/smartphones/trashed').then(res=>{
					this.trashed= res.data;
					this.trashedCount=this.trashed.data.length
					this.loading=false
				})
			},
			getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/smartphones/paginated/?page=' + page)
        .then(response => {
            this.smartphones = response.data;
            this.loading=false;
        });
      },

      getResultsTrashed(page = 1) {
        this.loading=true;
        axios.get('/admin/smartphones/trashed/?page=' + page)
        .then(response => {
            this.trashed = response.data;
            this.loading=false;
        });
      },

      trashSmartphone(id){
      	this.loading=true;
      	axios.get('/admin/smartphones/trash/'+id).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Smartphone added to trash successfully',
          });
          this.loadTrashed()
					this.loadSmartphone()
          this.loading=false
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      restore(id){
      	this.loading=true;
      	axios.get('/admin/smartphones/restore/'+id).then(()=>{
      		Toast.fire({
            icon: 'success',
            title: 'Smartphone restored successfully',
          });
          this.loadTrashed()
					this.loadSmartphone()
          this.loading=false
      	}).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      }
		},
		created(){
			this.loadTrashed()
			this.loadSmartphone()
		}
	}
</script>

<style>
	
</style>