<template>
	<div>
		<Draggable class="container pt-4">
			<div v-for="(item, itemIndex) in template.items" :key="itemIndex" class="template__item w-50" :class="item[1]">
				{{ item[0] }}
			</div>
			<!--            <div class="template__item template__title">-->
			<!--                <span>Page Title</span>-->
			<!--            </div>-->
			<!--            <div class="template__item template__image">-->
			<!--                <span>Page Image</span>-->
			<!--            </div>-->
			<!--            <div class="template__item template__header">-->
			<!--                <span>Page Header</span>-->
			<!--            </div>-->
			<!--            <div class="template__item template__body">-->
			<!--                <span>Body Text</span>-->
			<!--            </div>-->
			<!--            <div class="template__item template__footer">-->
			<!--                <span>Footer Text</span>-->
			<!--            </div>-->
		</Draggable>
	</div>
</template>

<script>
	import Draggable from 'vuedraggable';

	export default {

		components: {
			Draggable,
		},
		
		data() {
			return {
				template: null,
			};
		},

		mounted() {
			this.createTemplateItems();
		},

		methods: {
			createTemplateItems() {
				this.template = {
					items: [
						['Bookify Page Title', 'title'],
						['Page Image', 'image'],
						['Page Header', 'header'],
						['Body Text', 'body'],
						['Footer Text', 'footer'],
						['File Uploads', 'uploads'],
						['Discounts', 'discounts'],
						['Coupons', 'coupons'],
						['Questions', 'questions'],
						['Notifications and Cancellation Policy', 'notifications'],
					],
				};
			},
		},
	};
</script>

<style lang="scss" scoped>
    .template {
        &__item {
            background: var(--light);
            padding: 20px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            transition: all .3s ease;
            cursor: grab;
            &:hover {
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            }
            &:active {
                cursor: grabbing;
            }
            &:not(:last-child) {
                margin-bottom: 20px;
            }

            &.image {
                min-height: 150px;
            }
            &.body {
                min-height: 250px;
            }
            &.footer {
                min-height: 100px;
            }
        }
    }
</style>
