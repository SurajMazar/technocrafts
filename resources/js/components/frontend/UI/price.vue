<template>
	<div>{{ price | dollar }}</div>
</template>

<script>
	export default{
		props:['price'],

	}
</script>