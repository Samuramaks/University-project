using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using LiveCharts;
using LiveCharts.Wpf;
using NLog;

namespace CourseWork
{
    public partial class Form5 : Form
    {
        Logger logger = LogManager.GetCurrentClassLogger();
        public Form5()
        {
            InitializeComponent();
        }

        private void Form5_Load(object sender, EventArgs e)
        {
        }   

        private void btBuild_Click(object sender, EventArgs e)
        {
            SeriesCollection piechartData = new SeriesCollection();
            try
            {
               for(int i = 0; i < Chart.Right.Count(); i++)
               {
                    piechartData.Add(new PieSeries
                    {
                        Title = $"Правильные ответы за {10*(i+1)} секунд",
                        Values = new ChartValues<int> { Chart.Right[i] },
                        DataLabels = true,
                    }) ;
               }
                
            }
            catch
            {
                ;
            }
            pieChart1.Series = piechartData;
            pieChart1.LegendLocation = LegendLocation.Bottom;

        }

        private void btReturn_Click(object sender, EventArgs e)
        {
            Form f = new Form1();
            f.Show();
            this.Hide();
            logger.Info("Был переход на главную");
        }
    }
}
