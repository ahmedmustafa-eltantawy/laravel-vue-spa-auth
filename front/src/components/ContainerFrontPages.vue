<template>
	<div class="container" :class="classes">
		<slot name="content"></slot>
	</div>
</template>

<script>
	export default {
		props: {
			classes: {
				type: String,
				required: false,
				default: "",
			},
		},
	};
</script>
