using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using NLog;
using System.IO;

namespace CourseWork
{
    public partial class Form1 : Form
    {
        Logger logger = LogManager.GetCurrentClassLogger();
        public Form1()
        {
            InitializeComponent();
            Chart.Right = new List<int>();
            
        }
        private void btForward_Click(object sender, EventArgs e)
        {
            if (radioButton1.Checked)
            {
                ShowForm("Новичок.txt", "Новичок");
                logger.Info("Выбран уровень сложности Новичок");
            }
            if (radioButton2.Checked)
            {
                ShowForm("Продвинутый.txt", "Продвинутый");
                logger.Info("Выбран уровень сложности Продвинутый");
            }
            if (radioButton3.Checked)
            {
                ShowForm("Профи.txt", "Профи");
                logger.Info("Выбран уровень сложности Профи");
            }
        }
        private void ShowForm(string FileName, string FormName)
        {
            Form2 f = new Form2(FileName);
            f.Show();
            f.Text = FormName;
            Hide();
        }

        private void btExit_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btDelete_Click(object sender, EventArgs e)
        {
            File.Delete("Info.log");
            File.Create("Info.log");
        }
    }
}
