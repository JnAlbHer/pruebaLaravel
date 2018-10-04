<template>
	<div class="row">
			<div class="col-sm">
					<div class="form-group">
						<label>Titulo de la tarea</label>
						<input class="form-control" type="text" v-model="title">
					</div>

					<div class="form-group">
						<label>Fecha para realizarla</label>
						<input class="form-control" type="date" v-model="time">
					</div>
					<button class="btn btn-block btn-primary" @click="addTask">
					Agregar tarea
					</button>
			</div>
	</div>
</template>
<script type="text/javascript">

	export default {

		data(){
			return{
				title: '',
				time: ''
			}
		},

		props: {
			id: {
				required: true
			}

		},

		computed: {
			formData: function() {
				return {
					title: this.title,
					time: this.time,
					id: this.id
				}
			}
		},
		methods:{
			addTask(){
				axios.post('/api/task', this.formData).then(res =>{
					alert("Tarea agregada")
					this.getTasks()
				}).catch(err =>{
					console.log(err)
				})
				this.title = '',
				this.time = ''
			},
			getTasks() {
				axios.get('/api/task?id=${this.id}').then(res=>{
						console.log(res.data)
					}).catch(err =>{
						console.log(err)
					})
			}
		}
	}
</script>

<style lang="scss">
	//
</style>