<template>
	<div class="card card-body" :class="styles">
		<slot name="card-body"></slot>
	</div>
</template>

<script>
	export default {
		name: "UiCard",
		props: {
			styles: {
				type: String,
				required: false,
				default: "bg-light",
			},
		},
		data() {
			return {};
		},
	};
</script>
