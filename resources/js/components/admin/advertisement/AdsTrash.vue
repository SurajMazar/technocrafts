<template>
	<!-- ads category listing -->
		<div class="row pt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Trashed Ads</h6>
						<!-- <div class="card-tools">
	            <div class="input-group input-group-sm" style="width: 150px;">
	              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
	              <div class="input-group-append">
	                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
	              </div>
	            </div>
	          </div> -->
					</div>
					<div class="card-body table-responsive p-0">
						<table class="table table-hover text-nowrap">
	            <thead>
	              <tr>
	                <th>Name</th>
	                <!-- <th>Category</th> -->
	                <th>Action</th>
	              </tr>
	            </thead>
	            <tbody v-if='!trashedCount'>
	            	<tr>
	            		<td colspan="4">Sorry! no data found.</td>
	            	</tr>
	            </tbody>
	            <tbody v-else>
	            	<tr v-for='(ad, index) in trashed.data' :key='ad.id'>
	            		<td>{{ ad.name }}</td>
	            		<!-- <td class="cat-list">{{ listCats(ad.ads_category) }}</td> -->
	            		<td>
	            			<button class="btn btn-primary btn-blue font-white mr-2" @click='restore(ad.id)'>
	            				<i class="fas fa-recycle mr-2"></i>restore
	            			</button>
	            			<button class="btn btn-danger btn-red mr-2 " >
	            				<i class="fas fa-times mr-2"></i>delete
	            			</button>
	            		</td>
	            	</tr>
	            </tbody>
	          </table>
					</div>	
					<div class="card-footer">
		        <pagination :data="trashed" @pagination-change-page="getTrashed"></pagination>
		      </div>	
				</div>
			</div>
		</div>
		<!-- end ads category listing -->

</template>
<script>
	export default{
		props:['trashed','trashedCount','getTrashed','restore'],
		data(){
			return{
				
			}
		},
		methods:{
			listCats(array){
				let cats='';
				if(array.length){
					if(array.length==1){
						cats=array[0].name;
					}else{
						let catsname=[];
						for (let i=0;i<array.length;i++){
							catsname[i]=array[i].name;
						}
						cats=catsname.join(' , ');
					}
				}else{
					cats='no category'
				}

				return cats;
				
			},
		}
	}
</script>
