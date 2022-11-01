<template>
  <Bar
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    css-classes=""
    :styles="styles"
    width="400px"
    height="100%"
  />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  components: { Bar },
  props: {
    data: {
      type: Object,
    },
    classes: {
      type: String
    },
    chartId: {
      type: String,
      default: 'bar-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: ''
    },
    height: {
      type: Number,
      default: ''
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },
  data() {
    return {
      chartData: {
        labels: Object.keys(this.$props.data),
        datasets: [{
          label: 'Views',
          backgroundColor: 'rgb(16 185 129)',
          data: Object.values(this.$props.data)
        }]
      },
      chartOptions: {
        responsive: true
      }
    }
  }
}
</script>