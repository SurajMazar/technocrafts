<template>
	<div class="container">
		<loader v-if='loading'></loader>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Writings</h3>
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
				          <th>Email</th>
				          <th>Contact</th>
				          <th>View writing</th>
				          <th>Status</th>
				          <th>Action</th>
				        </tr>
				      </thead>
				      <tbody v-if='writingCount==0'>
				      	<tr>
				      		<td colspan="5">Sorry, no data found!!</td>
				      	</tr>
				      </tbody>
				      <tbody v-else>
				      	<tr v-for='w in writings.data' :key='w.id'>
				      		<td>
				      			{{ w.name }}
				      		</td>

				      		<td>
				      			<a :href="'mailto:'+w.email">{{ w.email }}</a>
				      		</td>

				      		<td>
				      			{{ w.contact }}
				      		</td>

				      		


				      		<td>
				      			<button class="btn btn-primary btn-blue font-white" @click='open(w.id)'>
				      				<i class="fas fa-eye mr-1"></i>View
				      			</button>

				      			<div class="modal fade " :id="'writing-'+ w.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title"  id="exampleModalLongTitle">{{ w.title | Trim_title(25) }}</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
													<div class="modal-body" style="white-space: break-spaces;">
														<h1>{{ w.title }}</h1>
														<div v-html='w.content'></div>
													</div>
													 <div class="modal-footer">
											        <button type="button" class="btn btn-danger btn-red" data-dismiss="modal">Close</button>
											      </div>
												</div>
											</div>
										</div>
				      		</td>


				      		<td>
				      		{{ w.status }}
				      		</td>

				      		<td>
				      			<button class="btn btn-primary btn-blue font-white" v-if='w.status!=="Under review"' @click='review(w.id)'>
				      				Under review
				      			</button>
				      			<button class="btn btn-success btn-grn font-white" v-if='w.status!=="Approved"' @click='approve(w.id)'>
				      				Approve
				      			</button>
				      			<button class="btn btn-danger btn-red font-white" v-if='w.status!=="Rejected"' @click='reject(w.id)'>
				      				Reject
				      			</button>
				      		</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
				  <div class="card-footer">
				  	<pagination :data="writings" @pagination-change-page="getResults"></pagination>
				  </div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				loading:true,
				writings:{},
				writingCount:''
			}
		},
		methods:{
			loadWritings(){
				axios.get('/admin/writer-submission/paginated').then(res=>{
					this.writings=res.data
					this.writingCount=this.writings.data.length
					this.loading=false
				})
			},
			open(id){
				$('#writing-'+id).modal('show')
			},

			getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/writer-submission/paginated/?page=' + page)
        .then(response => {
            this.writings = response.data;
            this.loading=false;
        });
      },
      approve(id){
      	 this.loading=true;
        axios.get('/admin/writer-submission/approve/'+id)
        .then(() => {
           	Toast.fire({
	            icon: 'success',
	            title: 'Writing has been approved'
	          });
            this.loadWritings();
        }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      reject(id){
      	this.loading=true;
        axios.get('/admin/writer-submission/reject/'+id)
        .then(() => {
           	Toast.fire({
	            icon: 'success',
	            title: 'Writing has been rejected'
	          });
            this.loadWritings();
        }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },

      review(id){
				this.loading=true;
        axios.get('/admin/writer-submission/review/'+id)
        .then(() => {
           	Toast.fire({
	            icon: 'success',
	            title: 'Writing has been placed under review'
	          });
            this.loadWritings();
        }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
      },
		},
		mounted(){
			this.loadWritings();
		}
	}
</script>