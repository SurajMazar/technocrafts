<template>
	<div class="container pt-4">
		<div class="card">
			<div class="card-header bg-blue">
				<div class="card-title text-center ">
					EMI calculator
				</div>
			</div>
			<div class="card-body">
				<form @submit.prevent='totalStatement'>
				<div class="row pt-4">
					<div class="col-md-3">
						<div class="form-group">
							<label>Principle</label>
							<input type="text" v-model='principle' required class='form-control' disabled>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Rate (per annum)</label>
							<input type="text" v-model='rate' required class='form-control'>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Number of months</label>
							<input type="number" v-model='time' required max='500' min='0' class='form-control'>
						</div>
					</div>

					<div class="col-md-3 display-flex" v-if='computable()'>
						<div class="form-group">
							<button class='btn btn-primary btn-blue font-white'
							type="submit" 
							>Calculate EMI</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>

		<div class="col-md-12" v-if='statement.length'>
			
			<div class="col-md-12">
					<h5 class="text-center">EMI calculation table <hr style="margin-left:auto"></h5>
			</div>		

			<div class="row">

				<div class="col-md-4">
					<div class="card btn-grn" style="width: 18rem;">
					  <div class="card-body">
					    <h5 class="card-title">Total Payable</h5>
					    <p class="card-text">{{ this.total_payable | emi}}</p>
					  </div>
					</div>
				</div>

				<div class="col-md-4">
						<div class="card btn-blue" style="width: 18rem;">
					  <div class="card-body">
					    <h5 class="card-title font-white">Total intrest</h5>
					    <p class="card-text font-white">{{ this.total_intrest | emi}}</p>
					  </div>
					</div>
				</div>


				<div class="col-md-4">
					<div class="card btn-red" style="width: 18rem;">
					  <div class="card-body">
					    <h5 class="card-title">Intrest percent</h5>
					    <p class="card-text">{{ this.total_intrest_percent}}%</p>
					  </div>
					</div>
				</div>

			</div>

			<div class="card">

				<div class="card-body table-responsive p-0">
					<table class="table  table-hover text-nowrap">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">Month</th>
					      <th scope="col">Begining balance</th>
					      <th scope="col">EMI</th>
					      <th scope="col">principle</th>
					      <th scope="col">Intrest</th>
					      <th scope="col">Ending balance</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<tr v-for='(s,index) in statement' :key='index'>
					  		<td>{{ index+1 }}</td>
					  		<td>{{ s.beginingAmount | emi }}</td>
					  		<td>{{ emi | emi }}</td>
					  		<td>{{ s.principle | emi }}</td>
					  		<td>{{ s.intrest | emi }}</td>
					  		<td><span v-if='statement.length==index+1'>0</span><span v-else>{{ s.finalAmount | emi }}</span></td>
					  	</tr>
					  </tbody>
					</table>
				</div>

			</div>

																		

		</div>


	</div>
</template>
<script>
	export default{
		props:['price'],
		data(){
			return{
				principle:'',
				rate:'',
				time:'',
				total_intrest:0,
				total_payable:0,
				total_intrest_percent:0,
				statement:[],
				errors:[],
				emi:'',
			}
		},
		methods:{
			calculateEmi(){
				let p = parseFloat(this.principle)
				let r = (parseFloat(this.rate)/1200)
				let n = parseFloat(this.time)

					let end = Math.pow((1+r),n)

				const emi = (p*r*end)/(end-1)

				return emi.toFixed(2);
			},
			reset(){
				this.statement=[]
				this.total_intrest=0
				this.total_payable=0
				this.total_intrest_percent=0
				this.emi=''
			},
			totalStatement(){
				this.reset()
				let emi = this.calculateEmi()
				let n = parseFloat(this.time)
				let r = (parseFloat(this.rate)/1200)
				let principle = this.principle
				this.emi=emi;

				for(let i=0;i<n;i++){

					let intrest = r*principle;

					intrest = intrest.toFixed(2)

					let paidPrinciple = emi - intrest;

					paidPrinciple = paidPrinciple.toFixed(2)

					let finalPrinciple = principle - paidPrinciple;

					finalPrinciple = finalPrinciple.toFixed(2)

					this.total_intrest=this.fixed(parseFloat(this.total_intrest)+parseFloat(intrest),2);



					this.statement.push({
						beginingAmount:principle,
						principle:paidPrinciple,
						intrest:intrest,
						finalAmount:finalPrinciple
					})

					principle = finalPrinciple

				}

				this.total_payable=this.fixed(emi*n,2);

				this.total_intrest_percent =this.fixed(this.total_intrest*100/this.total_payable,2)

			},

			fixed(int, num){
				int=int.toFixed(num)
				return int
			},

			computable(){
				if(this.principle!==''){
					if(this.rate!==''){
						if(this.time!==''){
							return true
						}
					}
				}
				return false
			},
		},
		mounted(){
			this.principle=this.price
		}
	}
</script>

<style scoped>
.display-flex{
	display: flex;
	justify-content: center;
	align-items:center;
}	
</style>