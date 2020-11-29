<template>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						Trash
					</div>
				</div>

				<div class="card-body table-responsive p-0">
					<table class="table table-hover text-nowrap">
			      <thead>
			        <tr>
			          <th>Image</th>
			          <th>Name</th>
			          <th>Action</th>
			        </tr>
			      </thead>

			      <tbody v-if='trashCount'>
			      	<tr v-for='t in trashed.data' :key='t.id'>
			      		<td style="display: flex;justify-content: center;">
			      			<div class="brandImage">
			      				<img :src="t.images[0]"  alt="">
			      			</div>
				      	</td>
			      		<td>{{ t.name }}</td>
			      		<td>
			      			<button class="btn btn-primary btn-blue font-white" @click='restore(t.id)'>
			      				<i class="fas fa-recycle mr-1"></i>
			      				Restore
			      			</button>
			      		</td>
			      	</tr>
			      </tbody>

			      <tbody v-else>
			      	<td colspan='3' class="text-center"> Sorry no trash data found!!</td>
			      </tbody v-else>

			    </table>
			  </div>

			  <div class="card-footer">
				  	<pagination :data="trashed" @pagination-change-page="getResultsTrashed"></pagination>
				  </div>

			</div>
		</div>
	</div>
</template>
<script>
	export default{
		props:['trashed','restore','trashCount','getResultsTrashed'],
		data(){
			return{

			}
		},
		 mounted() {
    }
	}
</script>

<style scoped lang="scss">
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
