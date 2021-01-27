<template>
	<div ref="cropperModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="max-width: 400px;">
				<div class="modal-body">
					<div :class="{ 'cropper-rounded': ['avatar'].includes(mode) }">
						<img ref="image" :src="fileObjectUrl" class="w-100" alt="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Cancel
					</button>
					<button type="button" class="btn btn-primary" @click="apply">
						Apply
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Cropper from 'cropperjs';
	
	export default {
		props: {
			mode: {
				type: String,
				default: null,
			},
		},
		
		data() {
			return {
				cropper: null,
				croppedPreviewData: null,
				fileObjectUrl: null,
				fileName: null,
			};
		},
		
		mounted() {
			console.log('CropperModal mounted!');
			
			$(this.$refs.cropperModal).on('shown.bs.modal', () => {
				console.log(['avatar'], this.mode, 5545);
				this.cropper = new Cropper(this.$refs.image, {
					viewMode: 1,
					aspectRatio: ['avatar'].includes(this.mode) ? 1 : null,
					cropBoxMovable: false,
					cropBoxResizable: ['logo'].includes(this.mode),
					toggleDragModeOnDblclick: false,
					dragMode: 'move',
				});
			});
			
			$(this.$refs.cropperModal).on('hidden.bs.modal', () => {
				this.cropper.destroy();
				this.cropper = null;
			});
		},
		
		beforeDestroy() {
			$(this.$refs.cropperModal).off();
		},
		
		methods: {
			async show(file) {
				if (window.URL) {
					this.fileObjectUrl = URL.createObjectURL(file);
				} else if (window.FileReader) {
					this.fileObjectUrl = await new Promise((resolve) => {
						let reader = new FileReader();
						
						reader.onload = function () {
							resolve(reader.result);
						};
						
						reader.readAsDataURL(file);
					});
				} else {
					throw new Error(`Can't initialize cropper`);
				}
				
				this.fileName = file.name;
				
				$(this.$refs.cropperModal).modal({
					backdrop: 'static',
					keyboard: false,
				});
			},
			
			// updatePreview() {
			// 	const canvas = this.cropper.getCroppedCanvas();
			// 	this.croppedPreviewData = canvas.toDataURL('image/png');
			// },
			
			async apply() {
				let canvas = this.cropper.getCroppedCanvas();
				let cropData = this.cropper.getData();
				
				this.$emit('cropped', {
					crop: cropData,
					base64: canvas.toDataURL('image/png'),
					
					blob: await new Promise((resolve) => {
						return canvas.toBlob(resolve);
					}),
					
					fileName: this.fileName,
				});
				
				$(this.$refs.cropperModal).modal('hide');
			},
		},
	};
</script>
