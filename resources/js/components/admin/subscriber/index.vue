<template>
	<div class="container">
		<loader v-if='loading'></loader>

		<!-- brands list -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Subscribers</h3>
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
				      <thead>
				        <tr>
				          <th>Email</th>
				          <th>Action</th>
				        </tr>
				      </thead>
				      <tbody v-if='subscriberLength==0'>
				      	<tr>
				      		<td colspan="6">Sorry, no data found!!</td>
				      	</tr>
				      </tbody>
				      <tbody v-else>
				      	<tr v-for='subscriber in subscribers.data' :key='subscriber.id'>
				      		<td>{{ subscriber.email }}</td>
				      		<td>
				      			<button class="btn btn-danger btn-red" @click='deleteSubscriber(subscriber.id)'><i class="fas fa-trash mr-1"></i>Delete</button>
				      		</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
				  <div class="card-footer">
		        <pagination :data="subscribers" @pagination-change-page="getResults"></pagination>
				  </div>
				</div>
			</div>
		</div>
		<!-- end brand list -->
	</div>
</template>
<script>
	export default{
		data(){
			return{
				loading:false,
				subscribers:{},
				subscriberLength:0,
			}
		},
		methods:{
			loadSubscribers(){
				axios.get('/admin/subscribers/paginated').then(res=>{
					this.subscribers = res.data
					this.subscriberLength = this.subscribers.data.length
				})
			},
			deleteSubscriber(id){
				Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
		      	this.loading=true
		      	axios.get('/admin/subscribers/delete/'+id).then(()=>{
		      		Toast.fire({
		            icon: 'success',
		            title: 'Subscriber deleted successfully'
		          });
		      		this.loadSubscribers();
		      		this.loading=false;
		      	}).catch((response)=>{
							if(response.message=='Request failed with status code 401'){
								location.reload();
							}
							this.loading=false;
						});
		      }
		    }).catch((response)=>{
					if(response.message=='Request failed with status code 401'){
						location.reload();
					}
					this.loading=false;
				});
			},

			getResults(page = 1) {
        this.loading=true;
        axios.get('/admin/subscribers/paginated/?page=' + page)
        .then(response => {
            this.subscribers = response.data;
            this.loading=false;
        });
      },


		},

		mounted(){
			this.loadSubscribers();
		}
	}
</script>